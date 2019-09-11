/* 投稿フォームのエラーチェック*/

$(function(){ // $(function{}):HTMLを読み込んでから処理を実行する
	$('form').submit(function(){ // submitがクリックされたら行う処理
		// エラーメッセージをクリアする
		$('p.err_msg').remove();

		// POSTデータの用意
		var data = {}; // 空の連想配列を定義
		$('form input').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
			data[$(this).attr('name')] = $.trim($(this).val());
		});

		forminput = [];
		//formHTML = $('form').html();
	    //tempForm = {};
	    //formの内容を保存;
		$('form input').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
			forminput.push($(this));
		});

		/*for(i = 0; i < forminput.length; i++){
			console.log(forminput[i]);
		}*/
	    //var felem = $('form').elements;
	    /*felem.each(function(){
	    	tempForm[$(this).name] = $(this).value;
	    });*/
        /*for(var i = 0; i < felem.length; i++) {
            tempForm[felem[i].name] = felem[i].value;
        }*/

		// Ajaxの処理
		$.ajax({
			url: 'http://chibaapp.xsrv.jp/myscripts/booktohabit/errCheck.php',
			data: data,
			dataType: 'json',
			cache: false,
			type: 'POST',
			success: function(res){ // 通信成功(サーバからレスポンスが返ってくる)時の処理 res：レスポンス(JSON形式の配列[is_success, errors])
				if(!(res.is_success)){ // エラーメッセージありの場合
					var $target = null; // エラーが発生した入力項目の要素の定義

					$.each(res.errors, function(idx, error){
						$elem = $('form [name=' + error.nm + ']'); // エラーが発生した入力項目の取得

						$elem.after('<p class = "err_msg">' + error.message + '</p>'); // エラーが発生した入力項目の直前にエラーメッセージの要素追加

						if($target == null || $target.offset().top > $elem.offset().top){ // エラーが発生した入力項目が複数存在する場合、一番上の要素にスクロールを移動したい。その要素を取得
							$target = $elem;
						}
					});

					if($target != null){
						$target.focus();

						$targetDiv = $target.closest('div');
						$('html body').animate({scrollTop: $targetDiv.offset().top}, 200, 'swing');
					}
				}else{
					$('form').off('submit');

					i = 0;
					$('form input').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
						$(this).html(forminput[i]);
						i++;
					});
					$('form').submit();

					/*fmin[0] = forminput[0];
					fmin[1] = forminput[1];
					fmin[2] = forminput[2];
					fmin[3] = forminput[3];
					fmin[4] = forminput[4];*/

					/*$.each(forminput, function(i, value){
						fmin[i] = $(this);
						console.log(fmin[i]);
					});*/
					//console.log(forminput.length);
					//console.log(fmin.length);
					/*for(var j = 0; j < fmin.length; j++){
						//fmin[j] = forminput[j];
						console.log("fasdfa");
					}*/

					//$('form').html(formHTML);
		            /*var felem = $('form').elements;
		            for(var i = 0; i < felem.length; i++) {
		            	felem[i].value = tempForm[felem[i].name];
		            }*/
		            /*felem.each(function(){
		            	$(this).value = tempForm[$(this).name];
		    	    });*/

					//console("fasdjfkjakd");
				}
			}
		});

		return false; // ajaxによる処理が終わらないうちに送信しないようにする=>
	});
});