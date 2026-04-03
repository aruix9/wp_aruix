<?php
    // Include the header template file (header.php) which typically contains the HTML head, navigation, etc.
    get_header(); 
?>

<h1>Blog Posts</h1>

<?php
    // Check if there are any posts to display in the current query
    if (have_posts()) :
?>
    <?php
        // Start a loop to iterate through each post in the query
        while (have_posts()) : the_post();
    ?>
        <h2><?php the_title(); // Displays the title of the current post as an h2 heading ?></h2>
        <p><?php the_content(); // Displays the full content of the current post ?></p>

    <?php endwhile; ?>
<?php else : ?>
    <p>No posts found</p>
<?php endif; ?>

<?php 
    // Include the footer template file (footer.php) which typically contains closing HTML tags, scripts, etc.
    get_footer();
?>