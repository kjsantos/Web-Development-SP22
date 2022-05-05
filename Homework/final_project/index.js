let map;
	function initMap() {
		const bk = { lat: 40.678, lng: -73.9606 };
		const map = new google.maps.Map(document.getElementById("map"), {
			zoom: 200,
			center: bk,
		});
		const marker = new google.maps.Marker({
			position: bk,
			map: map,
		});
	}
	window.initMap = initMap;