var addRemoveNavStyle = function(){
	$(this).addClass('active').siblings().removeClass('active');
}

$(document).ready(function() {
    $("#main-nav li").click(addRemoveNavStyle);
    $("#main-nav li").first().addClass('active');
});