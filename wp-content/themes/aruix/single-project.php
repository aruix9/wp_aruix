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

        <div>
            <?php the_content(); // Displays the full content of the current post ?>
        </div>

    <?php endwhile; ?>
<?php endif; ?>

<?php
    // Include the footer template file (footer.php) which typically contains closing HTML tags, scripts, etc.
    get_footer();
?>