var addRemoveNavStyle = function(){
	console.log(this);
	$(this).addClass('active').siblings().removeClass('active');
}

$(document).ready(function() {
    $("#main-nav li").click(addRemoveNavStyle);
});