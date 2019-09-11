function handleFileSelect(evt){
	evt.stopPropagation();
	evt.preventDefault();

	files = evt.dataTransfer.files; //ドラッグ対象のファイル

	// File Objectのプロパティの追記
	var output = [];
	output.push('<li><strong>', escape(files[0].name), '</strong>(', files[0].type || 'n/a', ') - ', files[0].size, 'bytes, last modified: ', files[0].lastModifiedDate.toLocaleDateString(), '</li>');

	document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
}

function handleDragOver(evt){ // ドロップ対象のファイルのコピーを作る
	evt.stopPropagation();
	evt.preventDefault();
	evt.dataTransfer.dropEffect = 'copy';
}

function printThumbnail(evt){
	file = evt.dataTransfer.files[0]; // ドラッグされているファイルオブジェクト

	reader = new FileReader(); //

	reader.onload = function(){
		thumb = document.getElementById("thumb");
		thumb.src = reader.result;
	}

	reader.readAsDataURL(file);

	evt.preventDefault();
}

// イベントリスナーの設定
var dropZone = document.getElementById('imgzone');

dropZone.addEventListener('dragover', handleDragOver, false);
dropZone.addEventListener('drop', printThumbnail, false);