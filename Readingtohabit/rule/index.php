<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width">
<link rel="stylesheet" href="https://readingtohabit.jp/css/bootstrap.min.css">
<link rel="stylesheet" href="https://readingtohabit.jp/css/font-awesome.min.css">
<script src="https://readingtohabit.jp/js/jquery-3.3.1.slim.min.js"></script>

<title>Reading to habit | 利用規約</title>
</head>
<body>
<div id = "wrapper">

<?php if(empty($_SESSION['usrname'])):?>
<div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  	<h2 class = "text-primary">
  		<a href="https://readingtohabit.jp/index/">Reading to habit</a>
  	</h2>
  	<button type = "button" class = "navbar-toggler" data-toggle = "collapse" data-target = "#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Reading to habit">
  		<span class = "navbar-toggler-icon"></span>
  	</button>
    <div class = "collapse navbar-collapse justify-content-end" id = "navBar">
    	<ul class = "navbar-nav">
      		<li class="nav-item"><a href="https://readingtohabit.jp/index/index.html#detail" class="nav-link">Reading to habitとは</a></li>
      		<li class="nav-item active"><a href="https://readingtohabit.jp/registMember/registMember.html" class="nav-link">会員登録</a></li>
      		<li class="nav-item"><a href="https://readingtohabit.jp/auth/login.html" class="nav-link">ログイン</a></li>
    	</ul>
    </div>
  </nav>
</div>
<?php endif;?>

<?php if(isset($_SESSION['usrname'])):?>
<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<div class = "text-dark">
  		ようこそ<?php echo $_SESSION['usrname'];?>さん
  		</div>
  	<!-- data-toggle: 「なにをするか」の指定  -->
  		<button class = "navbar-toggler" data-toggle = "collapse" data-target = "#navBar" aria-expand = "false" aria-label = "Readint to habit">
  		<span class = "navbar-toggler-icon"></span>
  		</button>
    	<div class = "collapse navbar-collapse justify-content-end" id = "navBar">
    		<ul class = "navbar-nav">
      			<li class="nav-item active"><a href="https://readingtohabit.jp/auth/logout.php" class="nav-link">ログアウト</a></li>
    		</ul>
    	</div>
	</nav>
</div>
<?php endif;?>

<div class = "container">
<div class = "my-4 text-center">
	<h2>利用規約</h2>
</div>

<div class = "mb-2">
この利用規約（以下，「本規約」といいます。）は、Reading to habitがこのウェブサイト上で提供するサービス（以下，「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第1条（適用）</h3></div>
	<div class = "mb-2">
	本規約は，ユーザーのReading to habitの利用に関わる一切の関係に適用されるものとします。Reading to habitに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下，「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。
本規約の規定が前条の個別規定の規定と矛盾する場合には，個別規定において特段の定めなき限り，個別規定の規定が優先されるものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第2条（個人情報の定義）</h3></div>
	<div class = "mb-2">
	個人情報とは,本サービスを通じて利用者から取得するユーザー名,メールアドレス,パスワード,その他の利用者個人を特定できる情報のことを指します。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第3条（利用登録）</h3></div>
	<div class = "mb-2">
	本サービスにおいては，登録希望者が本規約に同意の上，Reading to habitの定める方法によって利用登録を申請し，Reading to habitがこの承認を登録希望者に通知することによって，利用登録が完了するものとします。
Reading to habitは，利用登録の申請者に以下の事由があると判断した場合，利用登録の申請を承認しないことがあり，その理由については一切の開示義務を負わないものとします。
	</div>
	<ol>
		<li>利用登録の申請に際して虚偽の事項を届け出た場合</li>
		<li>本規約に違反したことがある者からの申請である場合</li>
		<li>その他，Reading to habitが利用登録を相当でないと判断した場合</li>
	</ol>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第4条（ユーザー名およびパスワードの管理）</h3></div>
	<div class = "mb-2">
	ユーザーは，自己の責任において，本サービスのユーザー名およびパスワードを適切に管理するものとします。
ユーザーは，いかなる場合にも，ユーザー名およびパスワードを第三者に譲渡または貸与し，もしくは第三者と共用することはできません。Reading to habitは，ユーザー名とパスワードの組み合わせが登録情報と一致してログインされた場合には，そのユーザー名を登録しているユーザー自身による利用とみなします。
ユーザー名及びパスワードが第三者によって使用されたことによって生じた損害は，Reading to habitに故意又は重大な過失がある場合を除き，Reading to habitは一切の責任を負わないものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第5条（禁止事項）</h3></div>
	<div class = "mb-2">
	ユーザーは，本サービスの利用にあたり，以下の行為をしてはなりません。
	</div>
	<ol>
		<li>法令または公序良俗に違反する行為</li>
		<li>犯罪行為に関連する行為</li>
		<li>Reading to habit，本サービスの他のユーザー，または第三者のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為</li>
		<li>Reading to habitのサービスの運営を妨害するおそれのある行為</li>
		<li>他のユーザーに関する個人情報等を収集または蓄積する行為</li>
		<li>不正アクセスをし，またはこれを試みる行為</li>
		<li>他のユーザーに成りすます行為</li>
		<li>Reading to habitのサービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為</li>
		<li>Reading to habit，本サービスの他のユーザーまたは第三者の知的財産権，肖像権，プライバシー，名誉その他の権利または利益を侵害する行為</li>
	</ol>
	<div class = "mb-2">
	以下の表現を含み，または含むとReading to habitが判断する内容を本サービス上に投稿し，または送信する行為
	</div>
	<ol>
		<li>過度に暴力的な表現</li>
		<li>露骨な性的表現</li>
		<li>人種，国籍，信条，性別，社会的身分，門地等による差別につながる表現</li>
		<li>その他反社会的な内容を含み他人に不快感を与える表現</li>
	</ol>
	<div class = "mb-2">
	以下を目的とし，または目的とするとReading to habitが判断する行為
	</div>
	<ol>
		<li>その他本サービスが予定している利用目的と異なる目的で本サービスを利用する行為</li>
		<li>その他，Reading to habitが不適切と判断する行為</li>
	</ol>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第6条（本サービスの提供の停止等）</h3></div>
	<div class = "mb-2">
	Reading to habitは，以下のいずれかの事由があると判断した場合，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。Reading to habitは，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。
	</div>
	<ol>
		<li>本サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
		<li>地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合</li>
		<li>コンピュータまたは通信回線等が事故により停止した場合</li>
		<li>その他，Reading to habitが本サービスの提供が困難と判断した場合</li>
	</ol>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第7条（著作権）</h3></div>
	<div class = "mb-2">
	ユーザーは，自ら著作権等の必要な知的財産権を有するか，または必要な権利者の許諾を得た文章，画像や映像等の情報に関してのみ，本サービスを利用し，投稿ないしアップロードすることができるものとします。
ユーザーが本サービスを利用して投稿ないしアップロードした文章，画像の著作権については，当該ユーザーその他既存の権利者に留保されるものとします。ただし，Reading to habitは，本サービスを利用して投稿ないしアップロードされた文章，画像について，本サービスの改良，品質の向上，または不備の是正等ならびに本サービスの周知宣伝等に必要な範囲で利用できるものとし，ユーザーは，この利用に関して，著作者人格権を行使しないものとします。
前項本文の定めるものを除き，本サービスおよび本サービスに関連する一切の情報についての著作権およびその他の知的財産権はすべてReading to habitまたはReading to habitにその利用を許諾した権利者に帰属し，ユーザーは無断で複製，譲渡，貸与，翻訳，改変，転載，公衆送信（送信可能化を含みます。），伝送，配布，出版，営業使用等をしてはならないものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第8条（利用制限および登録抹消）</h3></div>
	<div class = "mb-2">
	Reading to habitは，ユーザーが本規約のいずれかの条項に違反した場合には，事前の通知なく，投稿データを削除し，ユーザーに対して本サービスの全部もしくは一部の利用を制限しまたはユーザーとしての登録を抹消することができるものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第9条（退会）</h3></div>
	<div class = "mb-2">
	ユーザーは，Reading to habitの定める退会手続により，本サービスから退会できるものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第10条（免責事項）</h3></div>
	<div class = "mb-2">
	Reading to habitは，本サービスに事実上または法律上の瑕疵（安全性，信頼性，正確性，完全性，有効性，特定の目的への適合性，セキュリティなどに関する欠陥，エラーやバグ，権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。
Reading to habitはユーザーが本サービスによって行った一切の行為と、その結果及び当該行為によって被った損害について一切の責任を負いません。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第11条（サービス内容の変更等）</h3></div>
	<div class = "mb-2">
	Reading to habitは，ユーザーに通知することなく，本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし，これによってユーザーに生じた損害について一切の責任を負いません。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第12条（利用規約の変更）</h3></div>
	<div class = "mb-2">
	Reading to habitは，必要と判断した場合には，ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお，本規約の変更後，本サービスの利用を開始した場合には，当該ユーザーは変更後の規約に同意したものとみなします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第13条（個人情報の取扱い）</h3></div>
	<div class = "mb-2">
	Reading to habitは，本サービスの利用によって取得する個人情報については，Reading to habit「プライバシーポリシー」に従い適切に取り扱うものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第14条（通知または連絡）</h3></div>
	<div class = "mb-2">
	ユーザーとReading to habitとの間の通知または連絡は，Reading to habitの定める方法によって行うものとします。Reading to habitは,ユーザーから,Reading to habitが別途定める方式に従った変更届け出がない限り,現在登録されている連絡先が有効なものとみなして当該連絡先へ通知または連絡を行い,これらは,発信時にユーザーへ到達したものとみなします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第15条（権利義務の譲渡の禁止）</h3></div>
	<div class = "mb-2">
	ユーザーはReading to habitの事前の承諾なく，利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し，または担保に供することはできません。
	</div>
</div>

<div class = "mb-4">
	<div class = "mb-2"><h3>第16条（準拠法・裁判管轄）</h3></div>
	<div class = "mb-2">
	本規約の解釈にあたっては，日本法を準拠法とします。
	</div>
</div>

</div>

<footer class = "bg-light">
	<div class = "text-center">
		<a class = "text-dark" href = "https://readingtohabit.jp/rule/">利用規約</a> | <a class = "text-dark" href = "https://readingtohabit.jp/privacyPolicy/">プライバシーポリシー</a>
	</div>
	<div class = "text-center">
		© Reading to habit
	</div>
</footer>
</div>
</body>
<script src="https://readingtohabit.jp/js/bootstrap.bundle.min.js"></script>
</html>