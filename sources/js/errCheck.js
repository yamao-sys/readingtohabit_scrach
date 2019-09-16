/* 投稿フォームのエラーチェック*/

$(function(){ // $(function{}):HTMLを読み込んでから処理を実行する
	$('form').submit(function(){ // submitがクリックされたら行う処理
		// エラーメッセージをクリアする
		$('p.err_msg').remove();

		// POSTデータの用意
		forminput = []; // エラーなし時、もともとの送信先に送るため、フォームデータを取っておく<input>タグ用
		textinput = []; // エラーなし時、もともとの送信先に送るため、フォームデータを取っておく<textarea>タグ用

		var data = {}; // 空の連想配列を定義
		$('form input').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
			if($(this).attr('type') == 'checkbox'){
				if($(this).prop('checked') == true){
					data[$(this).attr('name')] = $.trim($(this).val());
				}
				else{
					data[$(this).attr('name')] = '';
				}
			}
			else{
				data[$(this).attr('name')] = $.trim($(this).val());
			}

			forminput.push($(this));
		});

		$('form textarea').each(function(){ // textareaがある場合はこちら
			data[$(this).attr('name')] = $(this).val();
			textinput.push($(this));
		});

		// Ajaxの処理
		$.ajax({
			url: 'https://readingtohabit.jp/errCheck.php',
			data: data,
			dataType: 'json',
			cache: false,
			type: 'POST',
			success: function(res){ // 通信成功(サーバからレスポンスが返ってくる)時の処理 res：レスポンス(JSON形式の配列[is_success, errors])
				if(!(res.is_success)){ // エラーメッセージありの場合
					var $target = null; // エラーが発生した入力項目の要素の定義

					$.each(res.errors, function(idx, error){
						$elem = $('form [name=' + error.nm + ']'); // エラーが発生した入力項目の取得
						if($elem.attr('type') == 'checkbox'){
							$elem.parent().after('<p class = "err_msg">' + error.message + '</p>'); // エラーが発生した入力項目の直前にエラーメッセージの要素追加
						}
						else{
							$elem.after('<p class = "err_msg">' + error.message + '</p>'); // エラーが発生した入力項目の直前にエラーメッセージの要素追加
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
					j = 0;
					$('form input').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
						// $(this).html(forminput[i]);
						$(this).val(forminput[i].val());
						i++;
					});
					$('form textarea').each(function(){ // フォーム要素それぞれの値をPOSTデータに格納
						$(this).val(textinput[j].val());
						j++;
					});
					$('form').submit(); // JSでsubmit()すると、submitのnameが飛ばない
				}
			}
		});

		return false; // ajaxによる処理が終わらないうちに送信しないようにする=>
	});
});