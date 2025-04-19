<?php
include 'includes/header.php';
include 'includes/config.php';

// Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Map category slugs to titles
$categoryTitles = [
    'conduit-pipes' => 'Conduit Pipes & Fittings',
    'metal-gang-boxes' => 'Metal Gang Boxes',
    'wires' => 'Wires',
    'switches' => 'Switches & Accessories',
    'lights' => 'Ceiling Architect Lights',
    'decorative-lights' => 'Decorative Lights & Chandeliers',
    'fans' => 'Fans',
    'pipes-fittings' => 'Sanitary Pipes & Fittings',
    'faucets' => 'Faucets',
    'water-closets' => 'Water Closets',
    'basins' => 'Basins',
    'fitting-accessories' => 'Fitting Accessories'
];

// Get category title
$categoryTitle = isset($categoryTitles[$category]) ? $categoryTitles[$category] : 'Products';

// Get brands for this category (this would normally come from a database)
$categoryBrands = [
    'conduit-pipes' => ['Astral', 'JPPL (Jindal Polytubes Pvt Ltd)', 'AA+', 'Ultratuff (by Birla Group)'],
    'metal-gang-boxes' => ['JPPL', 'Sagar (20 gauge)', 'Normal (22 gauge)', 'Ultratuff'],
    'wires' => ['Anchor', 'Havells', 'V-Guard', 'Finolex', 'KEI', 'RR Kabel', 'Polycab'],
    'switches' => ['Amron', 'Anchor', 'Lauritz Knudsen', 'Havells', 'Polycab', 'V-Guard'],
    'lights' => ['Jaquar', 'Ledure', 'Hyglow'],
    'fans' => ['Orient', 'Atomberg'],
    'pipes-fittings' => ['Ashirvad', 'Astral', 'Raksha', 'Kedara', 'Miraj'],
    'faucets' => ['Kohler', 'Jaquar', 'Cera', 'Somany', 'Jhonson', 'Oleana', 'Watertec', 'Raksha', 'Raddick'],
    'water-closets' => ['Bajoria', 'Cera', 'Somany', 'Holo', 'Libba'],
    'basins' => ['Bajoria', 'Cera', 'Somany', 'Holo', 'Libba']
];

// Get brands for current category
$brands = isset($categoryBrands[$category]) ? $categoryBrands[$category] : [];
?>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1 class="wow fadeInUp"><?php echo $categoryTitle; ?></h1>
            <p class="wow fadeInUp" data-wow-delay="0.2s">Premium quality products from top brands</p>
        </div>
        <div class="banner-overlay"></div>
    </section>

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><?php echo $categoryTitle; ?></li>
            </ul>
        </div>
    </section>

    <!-- Product Category Content -->
    <section class="product-category-content">
        <div class="container">
            <div class="category-overview wow fadeInUp">
                <h2><?php echo $categoryTitle; ?></h2>
                <?php if(!empty($brands)): ?>
                    <div class="brands-list">
                        <h3>Available Brands:</h3>
                        <ul>
                            <?php foreach($brands as $brand): ?>
                                <li><?php echo $brand; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Product Filter -->
            <div class="product-filter wow fadeInUp" data-wow-delay="0.2s">
                <div class="filter-group">
                    <label for="brand-filter">Filter by Brand:</label>
                    <select id="brand-filter">
                        <option value="all">All Brands</option>
                        <?php foreach($brands as $brand): ?>
                            <option value="<?php echo strtolower(str_replace(' ', '-', $brand)); ?>"><?php echo $brand; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="sort-by">Sort by:</label>
                    <select id="sort-by">
                        <option value="featured">Featured</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                    </select>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="products-grid">
                <?php
                // In a real application, this would come from a database
                // For demo purposes, we'll create some sample products
                $sampleProducts = [
                    [
                        'name' => 'Premium Conduit Pipe',
                        'brand' => 'Astral',
                        'price' => 1250,
                        'image' => 'conduit-pipe-1.jpg',
                        'features' => ['Fire retardant', 'Corrosion resistant', 'UV stabilized']
                    ],
                    [
                        'name' => 'Heavy Duty Gang Box',
                        'brand' => 'JPPL',
                        'price' => 350,
                        'image' => 'gang-box-1.jpg',
                        'features' => ['20 gauge thickness', 'Durable construction', 'Easy installation']
                    ],
                    [
                        'name' => 'Copper Wire',
                        'brand' => 'Havells',
                        'price' => 4200,
                        'image' => 'wire-1.jpg',
                        'features' => ['99.9% pure copper', 'FR grade', 'ISI marked']
                    ],
                    [
                        'name' => 'Modular Switch',
                        'brand' => 'Anchor',
                        'price' => 180,
                        'image' => 'switch-1.jpg',
                        'features' => ['Sleek design', 'Child safety', 'Long lifespan']
                    ],
                    [
                        'name' => 'LED Ceiling Light',
                        'brand' => 'Jaquar',
                        'price' => 3200,
                        'image' => 'light-1.jpg',
                        'features' => ['Energy efficient', 'Modern design', '3-year warranty']
                    ],
                    [
                        'name' => 'Designer Faucet',
                        'brand' => 'Kohler',
                        'price' => 5600,
                        'image' => 'faucet-1.jpg',
                        'features' => ['Brass construction', 'Ceramic disc', 'Water saving']
                    ]
                ];
                
                foreach($sampleProducts as $product): 
                ?>
                <div class="product-card wow fadeInUp" data-wow-delay="0.<?php echo rand(3, 6); ?>s" data-brand="<?php echo strtolower(str_replace(' ', '-', $product['brand'])); ?>">
                    <div class="product-image">
                        <img src="assets/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <div class="product-badge"><?php echo $product['brand']; ?></div>
                    </div>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <div class="product-features">
                            <ul>
                                <?php foreach($product['features'] as $feature): ?>
                                    <li><?php echo $feature; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="product-price">
                            <span>₹<?php echo number_format($product['price']); ?></span>
                        </div>
                        <div class="product-actions">
                            <a href="#" class="btn btn-outline" data-toggle="modal" data-target="#productModal-<?php echo strtolower(str_replace(' ', '-', $product['name'])); ?>">View Details</a>
                            <a href="quotation.php" class="btn btn-primary">Request Quote</a>
                        </div>
                    </div>
                </div>
                
                <!-- Product Modal -->
                <div class="product-modal" id="productModal-<?php echo strtolower(str_replace(' ', '-', $product['name'])); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3><?php echo $product['name']; ?></h3>
                            <span class="modal-close">&times;</span>
                        </div>
                        <div class="modal-body">
                            <div class="modal-image">
                                <img src="assets/images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            </div>
                            <div class="modal-details">
                                <div class="brand-info">
                                    <strong>Brand:</strong> <?php echo $product['brand']; ?>
                                </div>
                                <div class="price-info">
                                    <strong>Price:</strong> ₹<?php echo number_format($product['price']); ?>
                                </div>
                                <div class="specifications">
                                    <h4>Specifications:</h4>
                                    <ul>
                                        <?php foreach($product['features'] as $feature): ?>
                                            <li><?php echo $feature; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="availability">
                                    <i class="fas fa-check-circle"></i> In Stock
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="quotation.php" class="btn btn-primary">Request Quote</a>
                            <a href="contact.php" class="btn btn-outline">Contact Us</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Category Description -->
            <div class="category-description wow fadeInUp" data-wow-delay="0.4s">
                <h3>About <?php echo $categoryTitle; ?></h3>
                <p>Our <?php echo $categoryTitle; ?> collection features only the highest quality products from the most trusted brands in the industry. Whether you're working on a residential project or a large commercial installation, we have the right products to meet your needs.</p>
                <p>All our <?php echo $categoryTitle; ?> come with manufacturer warranties and our commitment to after-sales support. Our knowledgeable staff can help you select the perfect products for your specific requirements and budget.</p>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>