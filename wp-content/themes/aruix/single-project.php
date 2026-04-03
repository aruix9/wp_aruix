<?php
    // Include the header template file (header.php) which typically contains the HTML head, navigation, etc.
    get_header();
?>

<!-- Display a single project post -->
<?php
    // Check if there are any posts to display in the current query
    if (have_posts()) :
?>
    <?php
        // Start a loop to iterate through each post in the query
        while (have_posts()) : the_post();
    ?>

        <h1><?php the_title(); // Displays the title of the current post as an h1 heading ?></h1>
        <p><strong>Tech Stack:</strong> <?php echo get_post_meta(get_the_ID(), 'tech_stack', true); ?></p>

        <p><strong>Client:</strong> <?php echo get_post_meta(get_the_ID(), 'client_name', true); ?></p>
        <p><a href="<?php echo get_post_meta(get_the_ID(), 'project_url', true); ?>" target="_blank">Visit Project</a></p>
        <?php the_content(); // Displays the full content of the current post ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php
    // Include the footer template file (footer.php) which typically contains closing HTML tags, scripts, etc.
    get_footer();
?>