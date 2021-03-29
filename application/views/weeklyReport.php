<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include ('includes/header.php'); ?>
    <div id="loading" class="loading"></div>

	<div class="banner">
		<?php include ('includes/mainMenu.php'); ?>


		<div class="container">
			<div class="agile_banner_info">
				<div class="agile_banner_info1">
					<!-- <h3>Designed and developed by <span>IT Care</span></h3> -->
					<div id="typed-strings" class="agileits_w3layouts_strings">
						<p>better <i>education</i> for better world</p>
						<p><i>education</i> is a journey not a race</p>
						<p>character is a wish for a perfect <i>education</i></p>
					</div>
					<span id="typed" style="white-space:pre;"></span>
				</div>
			</div>
			<div class="banner_agile_para">
				<p>Harakhdeo Singh College Of Education Ramanuja Bagh, Khudaganj (Nalanda).</p>
			</div>
			<div class="w3_agile_social_icons">
				<ul class="agileinfo_social_icons">
					<li><a href="#" class="w3_agileits_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#" class="wthree_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="#" class="agileinfo_google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<div class="w3_banner_color">
				<span></span>
			</div>
			<div class="w3_scroll_arrow">
			  <a href="#team" class="scroll scroll-down"><span class="dot"> </span></a>
			</div>
		</div>
	</div>
	<!-- //banner -->
    <br/>
    <h1 class="text-center"> Weekly Report</h1>
	<div class="container">
        <div class="row">
            <div class="col-sm-12" id="weeklyReportContent">
                
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-primary" id="nextBtn">Next <i class="fa fa-arrow-right" ></i></button>
            </div>
        </div>

        <br/>
    </div>

	


<?php include ('includes/footer.php'); ?>

<script>
    
    var totalCount = 0;
    var currentIndex = 0;

    $('#nextBtn').on('click', function(){debugger
        if( currentIndex < 10 ){
            renderPage(0, currentIndex);
            return
        }
        renderPage(currentIndex - 10,currentIndex);
    })

    var renderPage = function(from, to){debugger
        $('#loading').addClass('loading');
        $.ajax({  
            type: "GET",
            url: "<?php $this->config->base_url()?>admin/weeklyReport/renderPage?from="+from+"&to="+to,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {debugger
                
                response = JSON.parse(response);
                var html = ``;
                
                if(response && response.data.length > 0){
                    $(response.data).each(function(key, value){
                        if( key == response.data.length - 1 )
                            currentIndex = value.id;
                        html += `<p class="my-card">
                                Month Year week ( Report for ) : `
                                +value.attendance_month+` `+value.year+` `+value.attendance_week+
                            ` ( `+value.attendance_for+` )
                                <br/>
                                Course ( course year ) : `+value.course+` ( `+value.course_year+` )
                                <br/>
                                Attachment <i class="fa fa-paperclip"></i>
                                <a href="admin/weeklyReports/`+value.attached_file+`" target="_blank"   title="`+value.attached_file+`">`+value.attached_file+`</a>
                                <br/>
                                <small>uploaded on : `+ value.uploaded_on +`</small>
                            </p>`;
                    })    
                    
                }

                $('#weeklyReportContent').html(html);
                $('#loading').removeClass('loading');
                
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    }

    var getAllNotifications = function(){
        $('#loading').addClass('loading');
        $.ajax({  
            type: "GET",
            url: "<?php $this->config->base_url()?>admin/weeklyReport/getAllReport",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {debugger
                
                response = JSON.parse(response);
                if(response && response.length > 0){
                    totalCount = response.length;
                    if( totalCount < 10 ){
                        renderPage(0,totalCount);
                        return;
                    }
                }
                $('#loading').removeClass('loading');
                renderPage( (totalCount - 10) ,totalCount);
                
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    };

    $(document).ready(function(){
        $('#loading').addClass('loading');
        getAllNotifications();
    });
</script>
