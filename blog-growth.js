document.getElementById("inquiry-form").addEventListener("submit", function (event) {
  event.preventDefault();
  const data = new FormData(event.currentTarget);
  const subject = "【ブログ運営】無料事前確認のお申し込み";
  const body = ["Mintoライフサポート ご担当者様","","無料事前確認を希望します。","","会社名・屋号: "+data.get("company"),"お名前: "+data.get("name"),"返信先メール: "+data.get("email"),"Webサイト: "+data.get("website"),"","商品・サービス:",data.get("service"),"","現在困っていること:",data.get("problem"),"","90日プランと料金を確認済みです。"].join("\n");
  window.location.href = "mailto:info@www-minto.com?subject="+encodeURIComponent(subject)+"&body="+encodeURIComponent(body);
});
