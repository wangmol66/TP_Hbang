require.config({
    paths : {
        "swiper" : ["swiper.min"],
        "jquery":["jquery.min"]
    }
})
require(["swiper"],function(){
   		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			paginationClickable: true
		});
		var mySwiper1 = new Swiper('#header',{
		  freeMode : true,
		  slidesPerView : 'auto',
		  slidesPerView: 3.5
		 });
})
