# Dear Minto 現在地マップ

作成日：2026-07-31 JST　／　最終更新：2026-07-31 JST

このファイルの目的は、**毎回あちこち探さずに現在地が分かるようにすること**。
AIに調べさせるとリポジトリ全体を読むことになり時間と費用がかかるため、まずこの1枚を読む。

---

## 1. 結論：どこが本番か

| 対象 | 本番の場所 | このリポジトリの状態 |
|---|---|---|
| 公式サイト www-minto.com | **WordPress**。テーマは `ProjectZeroHQ/project-zero` の `wordpress/dear-minto-4/`（**v1.4.1**） | `wordpress-theme/dear-minto/` は **v1.3.0の旧版** |
| 記事の公開 | `project-zero` のGitHub Actions（`.github/workflows/minto-morning-ai-*.yml`） | 静的HTMLの `blog/` は移行前の旧サイト |
| AI向けサイト情報 llms.txt | `project-zero` の `wordpress/dear-minto-4/llms.txt` | ルートとテーマの `llms.txt` は旧内容 |

**このリポジトリ（minto-site）は編集しない。** 直しても本番に反映されない。

判定根拠：`project-zero` の PR #483（2026-07-30 23:10）が、Minto記事をWordPressワークフロー経由で公開している。テーマも `dear-minto-4` v1.4.1 に更新済みで、旧版に無い `search.php` を持つ。

---

## 2. 今の3本のキャッシュポイント

本番トップページ（`dear-minto-4/front-page.php`）に並んでいる3枚。**無料 → 500円 → 980円**の階段になっている。

| 段 | 商品名 | 価格 | note | CEO評価（2026-07-31） |
|---|---|---:|---|---|
| 入口 | AIでつまずく7つの場面に、7つの道具 | **無料** | `n1e5df93a3591` | 集客の入口 |
| 主力 | 【保存版】ChatGPTを「質問相手」で終わらせない。AI社員を90分で作る7枚の指示書 | **¥980** | `n72b3571bd921` | **メイン商材** |
| 副次 | 「このバナー良くして」だけでは伝わらない | **¥500** | `n88e18fdd3e99` | サブ。反応が厳しく**没に近い** |

社内IDは、無料が `PRODUCT-007`、¥500が `PRODUCT-009`、主力¥980が **`PRODUCT-010`**（2026-07-31 CEO決定「A」で採番。2026-07-29公開）。

確認済み購入は会社全体で **0件**、確認済み売上 **JPY 0**。2026-07-31にnoteの販売履歴・売上管理画面で確定した一次証拠（2026-07全期間「購入者がいません」）。

---

## 3. 毎日の確認は、この順番で足りる

`project-zero` リポジトリの、次の順で読む。これ以外は開かなくてよい。

| 見たいこと | 読むファイル |
|---|---|
| 会社の現在地 | `CurrentStatus.md` |
| 今月の目標と現在の重点 | `CurrentMission.md` |
| 今日やること | `CurrentTasks.md` |
| 商品・価格・販売状態 | `ProductControl.md` |
| GitHub側の実行順と停止点 | Issue **#411**（COO HANDOFF） |
| 人が入れた数字 | Googleスプレッドシート `商品・販売管理` タブ |

`PROJECT_STATUS.md` と `HANDOFF.md` は**互換用のポインタ**であって、現在地の台帳ではない（`project-zero/README.md` に明記）。`MISSION_LOG.md`・`OPERATIONS_LOG.md`・`SALES_PHASE_MEMORY.md` は過去ログなので、現在地の判断に使わない。

---

## 4. 同時進行しているもの

**ここに一覧を書かない。** PRとIssueは日々変わるため、書いた翌日には嘘になる。

- 進行中の作業: `project-zero` の Open PR 一覧
- 実行順と停止点: `project-zero` の Issue **#411**（COO HANDOFF）
- 今日やること: `project-zero/CurrentTasks.md`

---

## 5. 見つかっている食い違い（未解決のみ）

2026-07-31に解決したものは本節から削除した。解決の経緯は `project-zero` の `docs/company-memory/2026-07-31_*.md` を見る。

| 内容 | 詳細 |
|---|---|
| PRODUCT-007 のnote URL | `n1e5df93a3591` は、旧記録では PRODUCT-005（7日でわかるAI仕事改善アプリ ¥1,980）のURL。同じnote記事を無料商品へ作り替えたと見られる |
| 共有シートに PRODUCT-007 行が無い | 2026-07-27照合時に未確認。GitHubとシートの同期が未完了（`ProductControl.md` 78行） |
| PRODUCT-009 のnote見出し画像 | 価格は¥500で確定済みだが、**画像だけ旧価格¥980のまま**。差し替えはCEO GO待ち |
| `WORDPRESS_THEME_README.md`（本リポジトリ） | 「切替前の注意・DNSは変更しない」が残っており、移行済みの現状と食い違う |

---

## 6. このリポジトリで終了したもの

| 名称 | 内容 | 終了日 | 理由 |
|---|---|---|---|
| ブログ運営おまかせ代行 | `blog-growth.html` / `.css` / `.js` | 2026-07-31 | 他商品と客層も価格帯も異なる別事業。WordPress移行時にテーマへ引き継がれておらず、本番に存在しなかった |

---

## 7. 更新ルール

- 本番の変更は **`project-zero` の `wordpress/dear-minto-4/`** を直す。このリポジトリは触らない
- 商品・価格・公開状態を変えたら `project-zero/ProductControl.md` と共有シートの両方を更新する
- 外部公開・価格変更・課金・顧客接触はCEO承認（Level 4）が必要
- 本ファイルは、本番の所在か3本のキャッシュポイントが変わったときだけ更新する
