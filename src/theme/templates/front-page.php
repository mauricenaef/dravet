<?php
/**
 * Template name: Front Page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bulma
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area section">
	<main id="main" class="site-main wrapper" role="main">
		<?php if ( have_posts() ) : ?>
			<div class="container">
				<div class="columns is-multiline">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="column is-one-third">
							<?php get_template_part( 'template-parts/content', 'post' ); ?>
						</div>
					<?php endwhile; ?>
				</div>
            </div>
            
            <div class="hero is-info is-large">
                <div class="hero-body">
                    <div class="container">
                    <h1 class="title">Bulma</h1>
                    <h2 class="subtitle" >Subptitle</h2>
                    <p class="subtitle"> Modern CSS framework based on <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Basic_Concepts_of_Flexbox">Flexbox</a></p>

                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="Input">
                        </div>
                    </div>

                    <div class="field">
                        <p class="control">
                            <span class="select is-rounded">
                                <select>
                                    <option>Select dropdown</option>
                                    <option>Value A</option>
                                    <option>Value B</option>
                                </select>
                            </span>
                        </p>
                    </div>

                    <div class="buttons">
                        <a class="button is-primary has-badge-rounded has-badge-danger" data-badge="8">Primary</a>
                        <a class="button is-link">Link</a>
                        <a class="is-link has-badge-rounded has-badge-danger" data-badge="3">Link</a>
                        
                    </div>

                    <hr>

                    <div class="dropdown is-active">
                        <div class="dropdown-trigger">
                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu2">
                            <span>Content</span>
                            <span class="icon is-small">
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                            </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu2" role="menu">
                            <div class="dropdown-content">
                            <div class="dropdown-item">
                                <p>You can insert <strong>any type of content</strong> within the dropdown menu.</p>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="dropdown-item">
                                <p>You simply need to use a <code>&lt;div&gt;</code> instead.</p>
                            </div>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                This is a link
                            </a>
                            </div>
                        </div>
                        </div>


                    </div>
                </div>
            </div>
            

			<div class="section pagination">
				<div class="container">
					<?php the_posts_pagination(); ?>
				</div>
            </div>
            <aside class="menu">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a>Dashboard</a></li>
                    <li><a>Customers</a></li>
                </ul>
                <p class="menu-label">
                    Administration
                </p>
                <ul class="menu-list">
                    <li><a>Team Settings</a></li>
                    <li>
                    <a class="is-active">Manage Your Team</a>
                    <ul>
                        <li><a>Members</a></li>
                        <li><a>Plugins</a></li>
                        <li><a>Add a member</a></li>
                    </ul>
                    </li>
                    <li><a>Invitations</a></li>
                    <li><a>Cloud Storage Environment Settings</a></li>
                    <li><a>Authentication</a></li>
                </ul>
                <p class="menu-label">
                    Transactions
                </p>
                <ul class="menu-list">
                    <li><a>Payments</a></li>
                    <li><a>Transfers</a></li>
                    <li><a>Balance</a></li>
                </ul>
                </aside>

                <nav class="panel">
                    <p class="panel-heading">
                        repositories
                    </p>
                    <div class="panel-block">
                        <p class="control has-icons-left">
                        <input class="input is-small" type="text" placeholder="search">
                        <span class="icon is-small is-left">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </span>
                        </p>
                    </div>
                    <p class="panel-tabs">
                        <a class="is-active">all</a>
                        <a>public</a>
                        <a>private</a>
                        <a>sources</a>
                        <a>forks</a>
                    </p>
                    <a class="panel-block is-active">
                        <span class="panel-icon">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        </span>
                        bulma
                    </a>
                    <a class="panel-block">
                        <span class="panel-icon">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        </span>
                        marksheet
                    </a>
                    <a class="panel-block">
                        <span class="panel-icon">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        </span>
                        minireset.css
                    </a>
                    <a class="panel-block">
                        <span class="panel-icon">
                        <i class="fas fa-book" aria-hidden="true"></i>
                        </span>
                        jgthms.github.io
                    </a>
                    <a class="panel-block">
                        <span class="panel-icon">
                        <i class="fas fa-code-branch" aria-hidden="true"></i>
                        </span>
                        daniellowtw/infboard
                    </a>
                    <a class="panel-block">
                        <span class="panel-icon">
                        <i class="fas fa-code-branch" aria-hidden="true"></i>
                        </span>
                        mojs
                    </a>
                    <label class="panel-block">
                        <input type="checkbox">
                        remember me
                    </label>
                    <div class="panel-block">
                        <button class="button is-link is-outlined is-fullwidth">
                        reset all filters
                        </button>
                    </div>
                    </nav>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
