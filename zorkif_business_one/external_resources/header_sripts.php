<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
	<script src="http://dev.jquery.com/view/tags/ui/latest/ui/effects.core.js"></script>
	<script src="http://dev.jquery.com/view/tags/ui/latest/ui/effects.slide.js"></script>
	<script type="text/javascript" src="../Scripts/Scripts/supersized.2.0.js"></script>

    <script type="text/javascript" src="../Scripts/Scripts/pngfix/jquery.pngFix.js"></script> 
    <script type="text/javascript"> 
    $(document).ready(function(){ 
        $(document).pngFix(); 
    }); 
</script>
	<script type="text/javascript">  
		$(function(){
			$.fn.supersized.options = {  
				startwidth: 640,  
				startheight: 480,
				vertical_center: 1,
				slideshow: 1,
				navigation: 1,
				transition: 1, //0-None, 1-Fade, 2-slide top, 3-slide right, 4-slide bottom, 5-slide left
				pause_hover: 1,
				slide_counter: 1,
				slide_captions: 1,
				slide_interval: 5000  
			};
	        $('#supersize').supersized(); 
	    });
	</script>