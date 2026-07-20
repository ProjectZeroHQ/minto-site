</main>
<footer class="site-footer">
  <div class="shell footer-grid">
    <div class="footer-brand">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="Dear Minto" width="150" height="150">
      <p>難しいAIを、毎日の仕事で<br>迷わず使えるものへ。</p>
    </div>
    <div>
      <h2>Explore</h2>
      <a href="<?php echo esc_url(home_url('/#services')); ?>">できること</a>
      <a href="<?php echo esc_url(home_url('/blog/')); ?>">AI仕事術</a>
      <a href="<?php echo esc_url(home_url('/#diagnosis')); ?>">無料診断</a>
    </div>
    <div>
      <h2>Information</h2>
      <a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a>
      <a href="<?php echo esc_url(home_url('/legal/')); ?>">特定商取引法に基づく表記</a>
      <a href="https://x.com/smileMinto" target="_blank" rel="noopener">X @smileMinto</a>
    </div>
  </div>
  <div class="shell footer-bottom"><span>© <?php echo esc_html(date('Y')); ?> Dear Minto</span><span>明るく、温かく、誠実に。</span></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

