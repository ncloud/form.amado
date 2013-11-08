<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>(일단은) 아마도 가게</title>
    <meta property="og:title" content="(일단은) 아마도 가게" />
    <meta property="og:description" content="'이야기를 파는 가게'라는 컨셉으로 작은 실험을 해보려고합니다. 당분간 그리고 일단은 이 곳을 '아마도 가게'라 명명합니다 :)" />

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/layout.css">
  </head>

  <body>
	<div id="social">
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fstore.amado.kr&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=205411999540915" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>	  
	</div>

    <div id="wrap">
      <div class="container">
        <div class="page-header">
          <h1>(일단은) 아마도 가게</h1>
        </div>
        
        <div class="view-wrap">
            <?php 
                include_once './library/Michelf/Markdown.php';
                include_once './library/Michelf/MarkdownExtra.php';
                
                use \Michelf\MarkdownExtra;
                echo MarkdownExtra::defaultTransform(file_get_contents('./view.md')); 
            ?>
        </div>
      </div>
    </div>
    
    <div id="forms">
        <div class="container">
            <div class="page-menu col-md-3">
                <h3>인터뷰 및 입점 신청</h3>
                <p>입점 전에 물건에 대한 (간단한) 인터뷰를 집행합니다. 인터뷰는 편한 대화형식이니 너무 부담갖지는 마세요 :)</p>
                <p>양식에 맞게 내용을 입력하시고 하단의 "신청하기" 버튼을 누르시면 신청이 완료됩니다.</p>
                <p>문의: <a href="mailto:me@ncloud.kr">me@ncloud.kr</a></p>
            </div>
            <div class="page-content col-md-9">
                <div id="form_message">
                    <h3>감사합니다</h3>
                    <p>인터뷰 신청이 완료되었습니다. 남겨주신 이메일<span class="email"></span>로 빠른 시일내에 연락드리겠습니다 :)</p>
                    <br />
                    <button class="btn btn-primary" onclick="hideThanks(); return false;">확인</button>
                </div>
            
                <form id="thanksform" method="POST" action="./action/add.php" class="form-horizontal" onsubmit="return onInterviewForm(this);">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">* 이름</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="from_name" placeholder="이름">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">* 이메일</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="from_email" placeholder="이메일 주소">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">* 물건 종류</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                          <input type="radio" name="object_type" value="used"> 사용하던 물건
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="object_type" value="gleaned"> 주운 물건
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="object_type" value="maked"> 만든 물건
                        </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputObjectName" class="col-sm-2 control-label">* 물건 이름</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputObjectName" name="object_name" placeholder="물건이름">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputMessage" class="col-sm-2 control-label">하고 싶은 말</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputMessage" name="message" placeholder="하고 싶은 말" rows="5"></textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">신청하기</button>
                    </div>
                  </div>
                </form>        
            </div>
            
            <div class="clearfix">
                <p class="text-muted credit">본 페이지는 <a href="https://github.com/ncloud/form.amado">오픈소스</a>로 공개했습니다.<!--마크다운(Markdown)으로 페이지 내용을 작성하고 구글 스프레드시트와 연동되어 있는 폼(양식)을 만드실 수 있습니다.--></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function showThanks() {
            var $form_message = $("#form_message");
            $form_message.show();
        }
        
        function hideThanks() {
            var $thanksform = $("#thanksform");
            var $form_message = $("#form_message");
            $form_message.hide();
            
            $thanksform.find("input").val('').removeAttr('checked');
            $thanksform.find("textarea").val('');
        }
    
        function onInterviewForm(form) {
            var $form = $(form);
            
            var $from_name = $form.find('input[name=from_name]');
            var $from_email = $form.find('input[name=from_email]');
            var $object_type = $form.find('input[name=object_type]:checked');
            var $object_name = $form.find('input[name=object_name]');
            var $message = $form.find('textarea[name=message]');


            if($from_name.val() == '') {
                $from_name.focus();
                return false;
            }
            
            if($from_email.val() == '') {
                $from_email.focus();
                return false;
            }
            if($object_type.length == 0 || $object_type.val() == '') {
                return false;
            }
            
            if($object_name.val() == '') {
                $object_name.focus();
                return false;
            }
            
            showThanks();
            
            $.ajax({
                type:"POST",
                url:"./action/add.php",
                data:"from_name=" + encodeURIComponent($from_name.val()) + "&from_email=" + encodeURIComponent($from_email.val()) + "&object_type=" + encodeURIComponent($object_type.val()) + "&object_name=" + encodeURIComponent($object_name.val()) + "&message=" + encodeURIComponent($message.val()),
                dataType:"json",
                success: function(data) {
                    
                }
            });
            
            return false;
        }
    </script>
  </body>
</html>
