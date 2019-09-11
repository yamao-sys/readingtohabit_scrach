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

<title>Reading to habit | プライバシーポリシー</title>
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
	<h2>プライバシーポリシー</h2>
</div>

<div class = "mb-2">
Reading to habitは，本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第1条（個人情報）</h3></div>
	<div class = "mb-2">
	個人情報とは,本サービスを通じてユーザーから取得するユーザー名,メールアドレス,パスワード,その他のユーザー個人を特定できる情報のことを指します。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第2条（個人情報の取得・利用について）</h3></div>
	<div class = "mb-2">
	Reading to habitは,下記の場合において、個人情報を取得・利用します。
	</div>
	<ol>
		<li>ユーザーがサービスを使用するため</li>
		<li>サービスの改善に役立てるため</li>
		<li>メンテナンス，重要なお知らせなど必要に応じたご連絡のため</li>
		<li>法的に必要だと認められた場合</li>
	</ol>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第3条（利用目的の変更）</h3></div>
	<div class = "mb-2">
	Reading to habitは，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。
利用目的の変更を行った場合には，変更後の目的について，Reading to habit所定の方法により，ユーザーに通知し，または本ウェブサイト上に公表するものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第4条（個人情報の第三者提供）</h3></div>
	<div class = "mb-2">
	Reading to habitは，次に掲げる場合を除いて，あらかじめユーザーの同意を得ることなく，第三者に個人情報を提供することはいたしません。ただし，個人情報保護法その他の法令で認められる場合を除きます。
	</div>
	<ol>
		<li>人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき</li>
		<li>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき</li>
		<li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
		<li>予め次の事項を告知あるいは公表し，かつReading to habitが個人情報保護委員会に届出をしたとき</li>
		<ol>
			<li>利用目的に第三者への提供を含むこと</li>
			<li>第三者に提供されるデータの項目</li>
			<li>第三者への提供の手段または方法</li>
			<li>本人の求めに応じて個人情報の第三者への提供を停止すること</li>
			<li>本人の求めを受け付ける方法</li>
		</ol>
	</ol>
	<div class = "mb-2">
	前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。
	</div>
	<ol>
		<li>Reading to habitが利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
		<li>個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合</li>
	</ol>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第5条（個人情報の開示）</h3></div>
	<div class = "mb-2">
	Reading to habitは，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します。
	</div>
	<ol>
		<li>本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合</li>
		<li>Reading to habitの業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
		<li>その他法令に違反することとなる場合</li>
	</ol>
	<div class = "mb-2">
	前項の定めにかかわらず，履歴情報および特性情報などの個人情報以外の情報については，原則として開示いたしません。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第6条（個人情報の利用停止等）</h3></div>
	<div class = "mb-2">
	Reading to habitは，本人から，個人情報が，利用目的の範囲を超えて取り扱われているという理由，または不正の手段により取得されたものであるという理由により，その利用の停止または消去（以下，「利用停止等」といいます。）を求められた場合には，遅滞なく必要な調査を行います。
前項の調査結果に基づき，その請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の利用停止等を行います。
Reading to habitは，前項の規定に基づき利用停止等を行った場合，または利用停止等を行わない旨の決定をしたときは，遅滞なく，これをユーザーに通知します。
前2項にかかわらず，利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって，ユーザーの権利利益を保護するために必要なこれに代わるべき措置をとれる場合は，この代替策を講じるものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第7条（プライバシーポリシーの変更）</h3></div>
	<div class = "mb-2">
	本ポリシーの内容は，法令その他本ポリシーに別段の定めのある事項を除いて，ユーザーに通知することなく，変更することができるものとします。
Reading to habitが別途定める場合を除いて，変更後のプライバシーポリシーは，本ウェブサイトに掲載したときから効力を生じるものとします。
	</div>
</div>

<div class = "mb-2">
	<div class = "mb-2"><h3>第8条（個人情報等の取り扱い）</h3></div>
	<div class = "mb-2">
	Reading to habitは、本サービスの提供に際してユーザーから取得した個人情報は、「プライバシーポリシー」に従い、適切に取り扱います。
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