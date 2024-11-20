const clientId = '6c4efac958884ff6882d7716e2a5c9f5';
const clientSecret = 'a4b62e545fec4457a757cdb7e5e1711c';
let accessToken = '';

document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const searchQuery = searchInput.value.trim();
        if (searchQuery) searchForAlbum(searchQuery);
    });

    // OBTER O ACCESS TOKEN DA API DO SPOTIFY
    async function getAccessToken() {
        const response = await fetch('https://accounts.spotify.com/api/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': 'Basic ' + btoa(clientId + ':' + clientSecret)
            },
            body: 'grant_type=client_credentials'
        });
        const data = await response.json();
        accessToken = data.access_token;
    }

    // BUSCAR ÁLBUNS NO SPOTIFY
    async function searchForAlbum(query) {
        try {
            await getAccessToken();

            const response = await fetch(`https://api.spotify.com/v1/search?q=${query}&type=album`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + accessToken
                }
            });

            const data = await response.json();
            const albums = data.albums.items;

            // BUSCAR POR PALAVRA DIGITADA E FILTRAR OS ÁLBUNS
            const searchWords = query.trim().toLowerCase().split(/\s+/);
            const filteredAlbums = albums.filter(album => {
                const albumName = album.name.toLowerCase();
                const artistNames = album.artists.map(artist => artist.name.toLowerCase()).join(' ');

                return searchWords.every(word => albumName.includes(word) || artistNames.includes(word));
            }).sort((a, b) => a.artists[0].name.localeCompare(b.artists[0].name));

            // EXIBIR OS RESULTADOS DA BUSCA
            if (filteredAlbums.length > 0) {
                searchResults.innerHTML = '';
                filteredAlbums.forEach(album => {
                    const albumElement = document.createElement('div');
                    albumElement.classList.add('album');
                    albumElement.innerHTML = ` 
                    <div class="album-card">
                        <img src="${album.images[0].url}" alt="${album.name}">
                        <div>
                            <h5 class="fw-bold fs-4" title="${album.name} (${album.release_date.substring(0, 4)})">${album.name} (${album.release_date.substring(0, 4)})</h5>
                            <p title="${album.artists.map(artist => artist.name).join(', ')}">${album.artists.map(artist => artist.name).join(', ')}</p>
                            <button class="btn fw-bold btn-warning save-btn" data-album-id="${album.id}" data-album-name="${album.name}" data-artist-name="${album.artists.map(artist => artist.name).join(', ')}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                                </svg>
                                Salvar
                            </button>
                        </div>
                    </div>
                    `;
                    searchResults.appendChild(albumElement);
                });
            } else {
                searchResults.innerHTML = '<p>Nenhum álbum encontrado.</p>';
            }
        } catch (error) {
            searchResults.innerHTML = '<p>Erro ao buscar álbuns.</p>';
        }
    }

    // BOTÃO DE SALVAR (MANDA PRO ALBUMSAVE.PHP, QUE SALVA O ÁLBUM NO BD)
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('save-btn')) {
            const { albumId, albumName, artistName } = event.target.dataset;
    
            const formData = new FormData();
            formData.append('submit', 'true');
            formData.append('album-id', albumId);
            formData.append('album-name', albumName);
            formData.append('artist-name', artistName);
    
            fetch('albumsave.php', {
                method: 'POST',
                body: formData
            }).then(() => {
                // Após o álbum ser salvo, altera o texto e desabilita o botão
                event.target.innerHTML = 'Salvo';
                event.target.classList.add('disabled'); // Adiciona a classe 'disabled' para desabilitar o botão
                event.target.disabled = true; // Desabilita o botão para impedir novos cliques
            }).catch(() => {
                alert('Erro ao salvar o álbum.');
            });
        }
    });
});
