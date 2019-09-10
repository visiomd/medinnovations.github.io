let navigationElements = ["#aboutPage", "#examplesPage"];
let showElements = ["#about", "#examples"];

navigationElements.forEach(function(el, index) {
	let elHtml = document.querySelector(el);
	elHtml.addEventListener('click', function() {
		let showElHtml = document.querySelector(showElements[index]);
		showElHtml.style.display = "block";
	})
})

