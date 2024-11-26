@extends('layouts.frontend.master')
@section('content')
<div class="home-mv"><img src="{{ asset ('img/10-img.png') }}" alt="" class="octoverse">
	<div class="txt-box">
		<div class="slide-ani clearfix">
			<img src="{{ asset ('img/10-img.png') }}" alt="">
			<h3 class="">Octoverse Payment Gateway Demo</h3><br><br>
		</div>
		<p class="eng-text">
		This website is a demo website that has been tested to understand the sample payment flow of Octoverse Payment Gateway. Please be informed that if you purchase items from this website, you will not actually receive the item, but your bank account will be charged for the value of the item.
		</p>
		<p class="myanmar-text">ယခု Website သည် Octoverse Payment Gateway ၏ Sample Payment Flow အား Testing ပြုလုပ်နိုင်စေရန် ရည်ရွယ်သည့် Demo Website ဖြစ်ပါသည်။ ယခု Website မှ Items များကို ဝယ်ယူပါက အဆိုပါပစ္စည်းအား အမှန်တကယ်ရရှိမည် မဟုတ်သော်လည်း လူကြီးမင်း၏ Bank Account မှ အဆိုပါ ပစ္စည်းတန်ဖိုး၏ ကျသင့်ငွေ ဖြတ်သွားမည်ဖြစ်ပါကြောင်း အသိပေးကြေညာ အပ်ပါသည်။ </p>

		<p class="eng-text" style="color: red;">
			*** The minimum amount is 1, and the maximum amount is 1000. ***
		</p>
		<a href="/products" class="shopNowBtn">Shop Now</a>
	</div>
</div>
@endsection