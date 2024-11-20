const clientId = '6c4efac958884ff6882d7716e2a5c9f5';
const clientSecret = 'a4b62e545fec4457a757cdb7e5e1711c';
let accessToken = '';

// Função para obter as IDs dos álbuns do endpoint PHP
async function getAlbumIds() {
    try {
        const response = await fetch('ids.php'); // Endpoint PHP para pegar as IDs dos álbuns
        const data = await response.json(); // Obtém as IDs no formato JSON
        return data; // Retorna as IDs dos álbuns
    } catch (error) {
        console.error('Erro ao buscar IDs dos álbuns:', error);
    }
}

// Função para obter o Access Token da API do Spotify
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

// Função para buscar informações de um álbum usando o ID do Spotify
async function getAlbumInfo(albumId) {
    if (!accessToken) {
        await getAccessToken();
    }

    try {
        const response = await fetch(`https://api.spotify.com/v1/albums/${albumId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });

        if (!response.ok) {
            throw new Error('Erro ao buscar informações do álbum');
        }

        const albumData = await response.json();
        return albumData;

    } catch (error) {
        console.error(error);
    }
}

// Função para buscar informações de um artista usando o ID do Spotify
async function getArtistInfo(artistId) {
    if (!accessToken) {
        await getAccessToken();
    }

    try {
        const response = await fetch(`https://api.spotify.com/v1/artists/${artistId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });

        if (!response.ok) {
            throw new Error('Erro ao buscar informações do artista');
        }

        const artistData = await response.json();
        return artistData;

    } catch (error) {
        console.error(error);
    }
}

// Função para buscar informações de vários álbuns a partir da lista com os IDs
async function getAlbumInfos() {
    const albumIds = await getAlbumIds(); // Obtém as IDs dos álbuns do PHP
    const albumInfos = [];

    for (const albumId of albumIds) {
        const albumData = await getAlbumInfo(albumId);
        albumInfos.push(albumData);
    }

    // Agrupar os álbuns por artista
    const albumsByArtist = albumInfos.reduce((acc, album) => {
        const artistName = album.artists[0].name;
        const artistId = album.artists[0].id;

        if (!acc[artistName]) {
            acc[artistName] = { albums: [], artistId: artistId };
        }

        acc[artistName].albums.push(album);
        return acc;
    }, {});

    // Ordenar os artistas por nome (ordem alfabética)
    const sortedArtists = Object.keys(albumsByArtist).sort();

    let accordionId = 0;

    // Exibir os álbuns agrupados por artista em ordem alfabética, e os álbuns em ordem de lançamento (mais recente primeiro)
    const allAlbumInfo = await Promise.all(sortedArtists.map(async (artist) => {
        const { albums, artistId } = albumsByArtist[artist];
        const artistData = await getArtistInfo(artistId);
        const artistImage = artistData.images.length > 0 ? artistData.images[0].url : '';

        // Ordenar álbuns do artista por data de lançamento (mais recente primeiro)
        const sortedAlbums = albums.sort((a, b) => new Date(b.release_date) - new Date(a.release_date));

        const currentId = `accordion${accordionId}`;
        const albumsHtml = sortedAlbums
            .map(album => {
                const releaseYear = new Date(album.release_date).getFullYear();
                const albumName = album.name.length > 20 ? album.name.substring(0, 17) + '...' : album.name;

                return `
                    <div style="display: inline-flex; flex-direction: column; align-items: center; margin: 10px; width: 200px; text-align: center;">
                        <img src="${album.images[0].url}" alt="Artwork" style="width: 200px; height: 200px; border-radius: 5%;" />
                        <h4 title="${album.name}" style="font-size: 20px; font-weight: bold; margin: 5px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${albumName}
                        </h4>
                        <p style="margin: 0;">${releaseYear}</p>
                        <button class="btn btn-danger mt-2" style="font-size: 12px;" onclick="removeAlbum('${album.id}')">Remover</button>
                    </div>
                `;
            })
            .join('');

        const artistHtml = `
            <div class="accordion" id="mainAccordion">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fs-4 fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#${currentId}">
                            <img src="${artistImage}" alt="${artist}" style="width: 100px; height: 100px; border-radius: 50%; margin-right: 20px;" />
                            ${artist}
                        </button>
                    </h2>
                    <div id="${currentId}" class="accordion-collapse collapse" data-bs-parent="#mainAccordion">
                        <div class="accordion-body container ps-3">
                            <div class="album-card py-2 container">${albumsHtml}</div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        accordionId++;
        return artistHtml;
    }));

    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = allAlbumInfo.join('');
}

// Função para remover o álbum da biblioteca
async function removeAlbum(albumId) {
    try {
        const response = await fetch('update_album.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                albumId: albumId,
                action: 'remove'
            })
        });

        const data = await response.json();
        if (data.success) {
            console.log('Álbum removido da biblioteca');
            // Remove o álbum da interface
            document.querySelector(`#album-${albumId}`).remove();
        } else {
            console.error('Erro ao remover álbum:', data.error);
        }
    } catch (error) {
        console.error('Erro ao chamar update_album.php:', error);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    getAlbumInfos(); // Chama a função para buscar as informações dos álbuns
});
