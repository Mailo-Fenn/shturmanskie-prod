function updateProductCount() {
    const formData = new FormData(document.querySelector('.catalog-list__filter-popup form'));
    const formButton = document.querySelector('.catalog-list__filter-popup form .catalog-list__filter-popup__btns .button_submit button');
    const formCountText = document.querySelector('.catalog-list__filter-popup form .catalog-list__filter-popup__btns .button_submit p');
    
    formData.append('ajax_action', 'get_product_count');
    
    fetch('/local/scripts/ajax/filter_count.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if(data.count <= 0) {
                formButton.setAttribute('disabled', true);
            }
            else {
                formButton.removeAttribute('disabled');
            }

            formCountText.textContent = data.text;
        } else {
            console.error('Ошибка получения количества товаров:', data.error);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
    })
    .finally(() => {

    });
}

document.addEventListener('DOMContentLoaded', function() {
    if(document.querySelector('.catalog-list__filter-popup form')) {
        updateProductCount();
        
        const filterElements = document.querySelectorAll('.catalog-list__filter-popup input, .catalog-list__filter-popup select');
        
        filterElements.forEach(element => {
            element.addEventListener('change', function() {
                updateProductCount();
            });
        });
    }
});

$(document).ready(function(){
	
	/*if ($(window).width() <= 576) {			
		$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/576.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');	
	}
	
	if ($(window).width() > 576 && $(window).width() <= 1024) {
		$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1024.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');			
	}
	
	if ($(window).width() > 1204 && $(window).width() <= 1600) {
		$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1600.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');			
	}
	
	if ($(window).width() > 1600 && $(window).width() <= 1920) {
		$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1920.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');			
	}
	
	if ($(window).width() > 1920) {
		$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/2500.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');			
	}	
*/	
	
	
	/*$(window).resize(function() { 
		
		if ($(window).width() <= 576) {	

			if($('#main_video').attr('src') != '/upload/mainvideo/576.mp4') {
				$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/576.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');
			}			
		}
		
		if ($(window).width() > 576 && $(window).width() <= 1024) {
			if($('#main_video').attr('src') != '/upload/mainvideo/1024.mp4') {
				$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1024.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');
			}			
		}
		
		if ($(window).width() > 1204 && $(window).width() <= 1600) {
			if($('#main_video').attr('src') != '/upload/mainvideo/1600.mp4') {
				$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1600.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');
			}			
		}
		
		if ($(window).width() > 1600 && $(window).width() <= 1920) {
			if($('#main_video').attr('src') != '/upload/mainvideo/1920.mp4') {
				$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/1920.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');
			}			
		}
		
		if ($(window).width() > 1920) {
			if($('#main_video').attr('src') != '/upload/mainvideo/2500.mp4') {
				$('#main_video_cont').html('<video id="main_video" autoplay  src="/upload/mainvideo/2500.mp4" poster="/upload/iblock/d1c/gjmfi885vdndl5th5rvu0alcrzgf0zdb.jpg" muted ></video>');
			}
		}		
		
	});*/
	
	
	

	
	
});