<?php
if (!defined('ABSPATH')) exit;

function dear_minto_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', ['height' => 120, 'width' => 360, 'flex-height' => true, 'flex-width' => true]);
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    register_nav_menus(['primary' => 'メインメニュー', 'footer' => 'フッターメニュー']);
}
add_action('after_setup_theme', 'dear_minto_setup');

function dear_minto_assets() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('dear-minto', get_template_directory_uri() . '/assets/css/site.css', [], $version);
    wp_enqueue_script('dear-minto', get_template_directory_uri() . '/assets/js/site.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'dear_minto_assets');

function dear_minto_analytics() {
    if (is_admin()) return;
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5QDN8RSYEW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-5QDN8RSYEW', { anonymize_ip: true });
      document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href*="note.com"]');
        if (!link) return;
        gtag('event', 'note_product_click', {
          link_url: link.href,
          link_text: (link.textContent || '').trim(),
          item_id: link.dataset.productId || '',
          item_name: link.dataset.productName || '',
          value: Number(link.dataset.productPrice || 0),
          currency: 'JPY',
          transport_type: 'beacon'
        });
      });
    </script>
    <?php
}
add_action('wp_head', 'dear_minto_analytics', 20);

function dear_minto_excerpt_length() { return 42; }
add_filter('excerpt_length', 'dear_minto_excerpt_length');

function dear_minto_menu_fallback() {
    echo '<ul class="site-nav__list">';
    echo '<li><a href="' . esc_url(home_url('/#services')) . '">商品を見る</a></li>';
    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">AI仕事術</a></li>';
    echo '<li><a href="' . esc_url(home_url('/#about')) . '">Dear Mintoについて</a></li>';
    echo '<li><a class="nav-cta" href="' . esc_url(home_url('/#diagnosis')) . '">無料で診断する</a></li>';
    echo '</ul>';
}

function dear_minto_body_classes($classes) {
    if (is_front_page()) $classes[] = 'is-front';
    return $classes;
}
add_filter('body_class', 'dear_minto_body_classes');

function dear_minto_seed_pages() {
    $blog = get_page_by_path('blog');
    if (!$blog) {
        $blog_id = wp_insert_post(['post_title' => 'AI仕事術', 'post_name' => 'blog', 'post_type' => 'page', 'post_status' => 'publish']);
    } else { $blog_id = $blog->ID; }
    if ($blog_id && !is_wp_error($blog_id)) update_option('page_for_posts', $blog_id);
    update_option('show_on_front', 'posts');

    $parent = get_page_by_path('tools');
    $parent_id = $parent ? $parent->ID : wp_insert_post(['post_title' => '無料ツール', 'post_name' => 'tools', 'post_type' => 'page', 'post_status' => 'publish']);
    if (!get_page_by_path('tools/first-ai-task-check')) {
        wp_insert_post(['post_title' => '最初のAI仕事診断', 'post_name' => 'first-ai-task-check', 'post_parent' => $parent_id, 'post_type' => 'page', 'post_status' => 'publish']);
    }
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'dear_minto_seed_pages');

function dear_minto_import_articles() {
    if (get_option('dear_minto_content_version') === '1.0') return;
    $file = get_template_directory() . '/assets/content/articles.json';
    if (!file_exists($file)) return;
    $articles = json_decode(file_get_contents($file), true);
    if (!is_array($articles)) return;
    $category = term_exists('AI仕事術', 'category');
    if (!$category) $category = wp_insert_term('AI仕事術', 'category', ['slug' => 'ai-work']);
    $category_id = is_array($category) ? (int) $category['term_id'] : 0;
    foreach ($articles as $index => $article) {
        if (get_page_by_path($article['slug'], OBJECT, 'post')) continue;
        wp_insert_post([
            'post_type' => 'post',
            'post_status' => 'publish',
            'post_title' => sanitize_text_field($article['title']),
            'post_name' => sanitize_title($article['slug']),
            'post_excerpt' => sanitize_text_field($article['excerpt']),
            'post_content' => wp_slash(wp_kses_post($article['content'])),
            'post_date' => sprintf('2026-07-18 09:%02d:00', $index),
            'post_category' => $category_id ? [$category_id] : [],
        ]);
    }
    update_option('dear_minto_content_version', '1.0');
}
add_action('admin_init', 'dear_minto_import_articles');

function dear_minto_seed_legal_pages() {
    if (get_option('dear_minto_legal_content_version') === '1.0') return;

    $privacy_content = <<<'HTML'
<p>Minto（以下「当事業者」といいます。）は、当サイトおよび提供するサービスにおける個人情報について、以下のとおり取り扱います。</p>
<h2>取得する情報</h2>
<p>当事業者は、お問い合わせやサービスのお申込み等に際して、氏名、メールアドレス、電話番号、お問い合わせ内容、その他必要な情報を取得する場合があります。</p>
<h2>利用目的</h2>
<ul>
<li>お問い合わせへの回答および必要なご連絡のため</li>
<li>商品・サービスの提供、代金の請求およびアフターサポートのため</li>
<li>サービスの改善、新しい商品・サービスの企画およびご案内のため</li>
<li>不正利用の防止および安全な運営のため</li>
<li>法令上必要な対応のため</li>
</ul>
<h2>第三者提供</h2>
<p>法令に基づく場合またはご本人の同意がある場合を除き、取得した個人情報を第三者へ提供しません。業務上必要な範囲で取扱いを外部へ委託する場合は、適切な委託先を選定し、必要な監督を行います。</p>
<h2>アクセス解析およびCookie</h2>
<p>当サイトでは、利用状況の把握とサービス改善のため、Google LLCが提供するGoogle Analyticsを利用しています。Google AnalyticsはCookie等を使用し、閲覧ページ、利用端末、参照元、当サイト内の操作等の情報を収集する場合があります。ブラウザの設定によりCookieを無効にできますが、一部機能に影響する場合があります。</p>
<h2>安全管理</h2>
<p>取得した個人情報について、不正アクセス、紛失、漏えい、改ざん等を防ぐため、必要かつ適切な安全管理措置を講じます。</p>
<h2>開示・訂正・削除等</h2>
<p>ご本人から個人情報の開示、訂正、利用停止または削除等の請求があった場合は、ご本人確認のうえ、法令に従って対応します。</p>
<h2>外部サービス</h2>
<p>当サイトから移動した外部サービス上で取得される情報は、各サービス提供者のプライバシーポリシーに基づいて取り扱われます。</p>
<h2>本ポリシーの変更</h2>
<p>法令の改正やサービス内容の変更等に応じて、本ポリシーを変更することがあります。重要な変更は当サイト上でお知らせします。</p>
<h2>お問い合わせ窓口</h2>
<p>屋号：Minto<br>運営責任者：川満 美穂<br>メール：<a href="mailto:info@www-minto.com">info@www-minto.com</a><br>電話番号：<a href="tel:07091931335">070-9193-1335</a></p>
<p>制定日：2026年7月20日</p>
HTML;

    $legal_content = <<<'HTML'
<div class="legal-table"><table><tbody>
<tr><th>販売事業者</th><td>Minto（個人事業主）</td></tr>
<tr><th>運営責任者</th><td>川満 美穂</td></tr>
<tr><th>所在地</th><td>請求があった場合、遅滞なく開示します。</td></tr>
<tr><th>電話番号</th><td><a href="tel:07091931335">070-9193-1335</a></td></tr>
<tr><th>メールアドレス</th><td><a href="mailto:info@www-minto.com">info@www-minto.com</a></td></tr>
<tr><th>販売価格</th><td>各商品・サービスの案内ページに税込価格を表示します。</td></tr>
<tr><th>販売価格以外の必要料金</th><td>銀行振込手数料およびインターネット接続に必要な通信料金は、お客様のご負担となります。</td></tr>
<tr><th>支払方法</th><td>銀行振込</td></tr>
<tr><th>支払時期</th><td>お申込み後7日以内にお支払いください。</td></tr>
<tr><th>商品・サービスの提供時期</th><td>入金確認後、各商品・サービスの案内ページに記載した時期に提供します。</td></tr>
<tr><th>返品・キャンセル</th><td>デジタル商品の性質上、提供開始後のお客様都合による返品・返金はお受けしていません。商品に不備がある場合は、確認のうえ交換または返金にて対応します。</td></tr>
<tr><th>動作環境</th><td>PDF等のデジタル商品を閲覧できる端末、インターネット環境および対応ソフトウェアが必要です。</td></tr>
</tbody></table></div>
<p class="legal-note">所在地の開示をご希望の場合は、上記メールアドレスまでご連絡ください。</p>
HTML;

    $pages = [
        'privacy' => ['title' => 'プライバシーポリシー', 'content' => $privacy_content],
        'legal'   => ['title' => '特定商取引法に基づく表記', 'content' => $legal_content],
    ];

    foreach ($pages as $slug => $data) {
        $page = get_page_by_path($slug);
        if (!$page) {
            wp_insert_post([
                'post_title' => $data['title'],
                'post_name' => $slug,
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_content' => wp_slash($data['content']),
            ]);
        } elseif (trim((string) $page->post_content) === '') {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => wp_slash($data['content']),
            ]);
        }
    }

    update_option('dear_minto_legal_content_version', '1.0');
}
add_action('admin_init', 'dear_minto_seed_legal_pages');

function dear_minto_blog_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('category_name', 'ai-work');
    }
}
add_action('pre_get_posts', 'dear_minto_blog_query');
