
var currentPage = window.location.href;

var navbarLinks = document.querySelectorAll("#navbar-links-list > li");
var set = false;
navbarLinks.forEach(link => {
	if(link.querySelector('a').href == currentPage){
		link.classList.add('current');
		set = true;
	}
});

if(!set){
	navbarLinks[0].querySelector('a').classList.add('current');
}