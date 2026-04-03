<?php
    // Include the header template file (header.php) which typically contains the HTML head, navigation, etc.
    get_header();
?>

<h1>All Projects</h1>

<!-- Display a list of project posts -->
<?php
    // Check if there are any posts to display in the current query
    if (have_posts()) :
?>
    <?php
        // Start a loop to iterate through each post in the query
        while (have_posts()) : the_post();
    ?>
        <h2>
            <?php // Displays the title of the current post as an h2 heading ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

    <?php endwhile; ?>
<?php endif; ?>

<?php
    // Include the footer template file (footer.php) which typically contains closing HTML tags, scripts, etc.
    get_footer();
?>