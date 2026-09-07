<?php
/*
Template Name: お問い合わせ
*/
; ?>
<?php get_header(); ?>
<div id="contents">
<div id="main">
<?php
if(function_exists('bcn_display'))
{
// Display the breadcrumb
echo '<p id="pan">';
bcn_display();
echo '</p>';
}
?>
<h2 class="subtitle03">お問い合わせフォーム<span class="sub">MAIL FORM</span></h2>
<div class="box">
<p>必要事項をご入力の上、「確認画面へ」ボタンをクリックしてください。<br>
※当社では、お客さまの個人情報の保護に関し、下記のように万全を期しておりますが、お客さまご自身におかれましても、情報の管理につきましては十分ご注意いただきますようお願いいたします。</p>
<div id="policy">
<p>当社は個人情報保護の重要性を認識し、以下の方針に基づき個人情報の保護に努めます。</p>
<ol>
<li>当社は、適法かつ公正な手段によって個人情報を取得します。</li>
<li>個人情報の取得の際は、その利用目的を明確にし、業務の遂行上必要な範囲内で利用します。</li>
<li>法令に定める場合を除き、個人情報を事前に本人の同意を得ることなく第三者に提供しません。<br>
ただし、個人情報の取扱いを第三者に委託する場合には、厳正な審査と適正な監督を行います。</li>
<li>受託業務において取得した個人情報は、適法かつ当該業務契約に定められた範囲内でのみ利用します。</li>
<li>個人情報の正確性を保ちこれを安全に管理いたします。</li>
<li>お客様から収集した個人情報について、開示・訂正・利用停止・消去等を求められた場合には、お客様本人であることを確認の上速やかに対応します。</li>
<li>当社は、従業員に対し個人情報の適正な管理方法についての教育・啓蒙を行うほか、個人情報を取扱う部門ごとに管理者をおいて、日常業務における個人情報の適切な管理と取扱いを当社従業者その他関係者に周知徹底します。</li>
</ol>
<p id="t-right">個人情報保護に関するお問い合わせ窓口<br>
大阪市西区靱本町1-20-13なにわ筋ビル3階<br>
三共スチール株式会社<br>
TEL. 06-6447-0101 FAX. 06-6447-0120</p>
</div>

<form id="mailformpro" action="<?php echo home_url(); ?>/mailform/mailformpro/mailformpro.cgi" method="POST">
	<dl class="mailform">
		<dt class="mfp">会社名</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="text" name="会社名" size="40">
				</div>
			</div>
		</dd>
		<dt class="mfp"><span class="must">必須</span>お名前又は担当者名</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="text" name="お名前又は担当者名" size="20" data-kana="フリガナ" required="required">
				</div>
			</div>
		</dd>
		<dt class="mfp">フリガナ</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="text" name="フリガナ" size="20" data-charcheck="kana">
				</div>
			</div>
		</dd>
		<dt class="mfp"><span class="must">必須</span>メールアドレス</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="email" data-type="email" name="email" size="40" required="required">
				</div>
			</div>
		</dd>
		
		<dt class="mfp"><span class="must">必須</span>確認用再入力</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="email" data-type="email" name="confirm_email" data-post-disable="1" size="40" required="required">
				</div>
			</div>
		</dd>
		<dt class="mfp">電話番号</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="tel" data-type="tel" name="電話番号" size="16" data-min="9">
				</div>
			</div>
		</dd>
		
		<dt class="mfp">郵便番号</dt>
		<dd class="mfp">
			<input type="hidden" name="ご住所" data-unjoin="〒+郵便番号+\n+都道府県+市区町村+丁目番地" value="">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<input type="text" name="郵便番号" size="30" data-address="都道府県,市区町村,市区町村">
				</div>
			</div>
		</dd>
		<dt class="mfp"><span class="must">必須</span>ご住所</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<select name="都道府県" required="required">
						<option value="" selected="selected">【選択して下さい】</option>
						<optgroup label="北海道・東北地方">
							<option value="北海道">北海道</option>
							<option value="青森県">青森県</option>
							<option value="岩手県">岩手県</option>
							<option value="秋田県">秋田県</option>
							<option value="宮城県">宮城県</option>
							<option value="山形県">山形県</option>
							<option value="福島県">福島県</option>
						</optgroup>
						<optgroup label="関東地方">
							<option value="栃木県">栃木県</option>
							<option value="群馬県">群馬県</option>
							<option value="茨城県">茨城県</option>
							<option value="埼玉県">埼玉県</option>
							<option value="東京都">東京都</option>
							<option value="千葉県">千葉県</option>
							<option value="神奈川県">神奈川県</option>
						</optgroup>
						<optgroup label="中部地方">
							<option value="山梨県">山梨県</option>
							<option value="長野県">長野県</option>
							<option value="新潟県">新潟県</option>
							<option value="富山県">富山県</option>
							<option value="石川県">石川県</option>
							<option value="福井県">福井県</option>
							<option value="静岡県">静岡県</option>
							<option value="岐阜県">岐阜県</option>
							<option value="愛知県">愛知県</option>
						</optgroup>
						<optgroup label="近畿地方">
							<option value="三重県">三重県</option>
							<option value="滋賀県">滋賀県</option>
							<option value="京都府">京都府</option>
							<option value="大阪府">大阪府</option>
							<option value="兵庫県">兵庫県</option>
							<option value="奈良県">奈良県</option>
							<option value="和歌山県">和歌山県</option>
						</optgroup>
						<optgroup label="四国地方">
							<option value="徳島県">徳島県</option>
							<option value="香川県">香川県</option>
							<option value="愛媛県">愛媛県</option>
							<option value="高知県">高知県</option>
						</optgroup>
						<optgroup label="中国地方">
							<option value="鳥取県">鳥取県</option>
							<option value="島根県">島根県</option>
							<option value="岡山県">岡山県</option>
							<option value="広島県">広島県</option>
							<option value="山口県">山口県</option>
						</optgroup>
						<optgroup label="九州・沖縄地方">
							<option value="福岡県">福岡県</option>
							<option value="佐賀県">佐賀県</option>
							<option value="長崎県">長崎県</option>
							<option value="大分県">大分県</option>
							<option value="熊本県">熊本県</option>
							<option value="宮崎県">宮崎県</option>
							<option value="鹿児島県">鹿児島県</option>
							<option value="沖縄県">沖縄県</option>
						</optgroup>
					</select>
				</div>
				<div class="mfp_col10">
					<input type="text" name="市区町村" placeholder="市区町村" required="required" size="50">
				</div>
				<div class="mfp_col10">
					<input type="text" name="丁目番地" placeholder="丁目番地" required="required" size="50">
				</div>
			</div>
		</dd>
		
		<dt class="mfp"><span class="must">必須</span>お問い合わせ内容</dt>
		<dd class="mfp">
			<div class="mfp_rows">
				<div class="mfp_col10">
					<textarea name="お問い合わせ内容" rows="10" cols="60" required="required"></textarea>
				</div>
			</div>
		</dd>
		
	</dl>
	<div class="mfp_buttons">
		<button type="submit">確認画面へ</button>
	</div>
</form>
<script type="text/javascript" id="mfpjs" src="<?php echo home_url(); ?>/mailform/mailformpro/mailformpro.cgi" charset="UTF-8"></script>
</div>


</div><!--main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
