  // Inicializar o mapa
  window.onload = function() {
    let map = tt.map({
        key: 't4XXN5DSEAGeKNUGjvQQXVmb6e8UKuPo',
        container: 'map',
        center: [-48.845, -26.304], // Coordenadas de Joinville
        zoom: 10
    });
};

let routeSource = null;  // Variável global para armazenar a fonte de rota

// Função para planejar a rota
function planRoute() {
    const start = document.getElementById("start").value;
    const end = document.getElementById("end").value;

    if (start && end) {
        const geocodeUrl = (location) => `https://api.tomtom.com/search/2/geocode/${encodeURIComponent(location)}.json?key=t4XXN5DSEAGeKNUGjvQQXVmb6e8UKuPo`;

        const getCoordinates = async (location) => {
            const response = await fetch(geocodeUrl(location));
            const data = await response.json();
            return data.results[0].position;
        };

        Promise.all([getCoordinates(start), getCoordinates(end)])
            .then(([startPos, endPos]) => {
                const routeUrl = `https://api.tomtom.com/routing/1/calculateRoute/${startPos.lat},${startPos.lon}:${endPos.lat},${endPos.lon}/json?key=t4XXN5DSEAGeKNUGjvQQXVmb6e8UKuPo&travelMode=bicycle`;

                return fetch(routeUrl);
            })
            .then(response => response.json())
            .then(data => {
                const route = data.routes[0].legs[0].points;
                const distanceMeters = data.routes[0].summary.lengthInMeters;
                const travelTimeSeconds = data.routes[0].summary.travelTimeInSeconds;

                const distanceKm = (distanceMeters / 1000).toFixed(2);
                const travelTimeMinutes = (travelTimeSeconds / 60).toFixed(2);

                function formatTravelTime(minutes) {
                    if (minutes >= 60) {
                        const hours = Math.floor(minutes / 60);
                        const remainingMinutes = Math.floor(minutes % 60);
                        return `${hours}h ${remainingMinutes}min`;
                    } else {
                        return `${Math.floor(minutes)} min`;
                    }
                }

                document.getElementById("routeInfo").innerHTML = `
                    <div class="route-info">
                        <i class="fas fa-road"></i> <p>Distância total: ${distanceKm} km</p>
                    </div>
                    <div class="route-info">
                        <i class="fas fa-bicycle"></i> <p>Tempo estimado de bicicleta: ${formatTravelTime(travelTimeMinutes)}</p>
                    </div>
                `;

                if (routeSource) {
                    map.removeLayer('routeLayer');
                    map.removeSource('routeSource');
                }

                routeSource = {
                    type: 'geojson',
                    data: {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            geometry: {
                                type: 'LineString',
                                coordinates: route.map(point => [point.longitude, point.latitude])
                            }
                        }]
                    }
                };

                map.addSource('routeSource', routeSource);
                map.addLayer({
                    id: 'routeLayer',
                    type: 'line',
                    source: 'routeSource',
                    paint: {
                        'line-color': '#28a745',
                        'line-width': 5
                    }
                });

                const bounds = new tt.LngLatBounds();
                route.forEach(point => bounds.extend([point.longitude, point.latitude]));
                map.fitBounds(bounds, { padding: 20 });
            })
            .catch(error => {
                console.error('Erro ao traçar a rota:', error);
            });
    } else {
        alert("Por favor, preencha os campos de partida e destino.");
    }
}