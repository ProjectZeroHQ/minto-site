# Dear Minto 共通キャンペーン連携

Project Zero CEO HubのCampaign Briefを、WordPressブログと商品CTAの正本入力として使います。

- Campaign ID: `CMP-YYYYMMDD-OFFER-NN`
- 必須URL項目: `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `campaign_id`
- WordPressのnote商品クリックは `campaign_id` をGA4イベントへ追加
- note・Xと同じCampaign IDを使う
- note本文の転載はせず、ブログは検索向けに再構成
- 公開文章に「川満」を含めない
- 72時間後の改善指示は一つだけ反映し、他の要素は維持
- 価格・公開・購入・広告は従来どおりCEO承認対象

CEO Hub: `GET /api/v1/revenue-cycle/brief?campaignId=...`
