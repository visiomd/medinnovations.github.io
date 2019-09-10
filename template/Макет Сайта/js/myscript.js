var navigationElements = ["#about", "#examples", "#contact"];

navigationElements.forEach(function(el) {
	let curEl = document.querySelector(el);
	curEl.addEventListener('click', function() {
		curEl.display = "block";
	})
})

