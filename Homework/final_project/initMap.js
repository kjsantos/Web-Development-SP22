function initMap() {
	// The location of Uluru
	const bk = { lat: 40.6782, lng: 73.9442 };
	// The map, centered at Uluru
	const map = new google.maps.Map(document.getElementById("map"), {
		zoom: 5,
		center: bk,
	});
	// The marker, positioned at Uluru
	const marker = new google.maps.Marker({
		position: bk,
		map: map,
	});
}
window.initMap = initMap;