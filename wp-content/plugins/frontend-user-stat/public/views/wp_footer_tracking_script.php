<script>
    ga('set', 'dimension1', '<?php echo get_current_user_id() ?>');
    
    ga('send', 'pageview', {
        'dimension1': '<?php echo get_current_user_id() ?>'
    });
</script>