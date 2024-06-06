<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

add_action( 'wp_enqueue_scripts', 'storefront_child_style' );
				function storefront_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
				}
				
function childthemename_scripts() {
	wp_enqueue_script(
		'custom-js',
		get_template_directory_uri() . '/js/custom.js',
		array( 'jquery' )
	);
} add_action( 'wp_enqueue_scripts', 'childthemename_scripts' );


/*
 *Tyagraj Bhatt Practical at Acquaint softtech
	
*/

// Add your custom order status action button (for orders with "processing" status)
add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
function add_custom_order_status_actions_button( $actions, $order ) {
    // Display the button for all orders that have a 'processing' status
    if ( $order->has_status( array( 'completed' ) ) ) {

        // The key slug defined for your action button
        $action_slug = 'invoice';

        // Set the action button
        $actions[$action_slug] = array(
            'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=agc_download_invoice&order_id=' . $order->get_id() ), 'woocommerce-order-invoice' ),
            'name'      => __( 'Download Invoice', 'woocommerce' ),
            'action'    => $action_slug,
        );
    }
    return $actions;
}

// Set Here the WooCommerce icon for your action button
add_action( 'admin_head', 'add_custom_order_status_actions_button_css' );
function add_custom_order_status_actions_button_css() {
    $action_slug = "invoice"; // The key slug defined for your action button

    echo '<style>.wc-action-button-'.$action_slug.'::after { font-family: woocommerce !important; content: "\2B73" !important; }</style>';
}

add_action( 'wp_ajax_nopriv_agc_download_invoice', 'agc_download_invoice_callback' );
add_action( 'wp_ajax_agc_download_invoice', 'agc_download_invoice_callback' );

function agc_download_invoice_callback() {
	$order_id = $_GET['order_id'];

	require_once $_SERVER['DOCUMENT_ROOT'].'/PracticalOrderPDF/wp-content/themes/storefront-child/TCPDF/examples/tcpdf_include.php';
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->setCreator(PDF_CREATOR);
	$pdf->setAuthor('Nicola Asuni');
	$pdf->setTitle('TCPDF Example 001');
	$pdf->setSubject('TCPDF Tutorial');
	$pdf->setKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	// $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	// $pdf->setFooterData(array(0,64,0), array(0,64,128));

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// ---------------------------------------------------------

	// set default font subsetting mode
	$pdf->setFontSubsetting(true);

	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$pdf->setFont('dejavusans', '', 14, '', true);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

	// set text shadow effect
	$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	$html = 'Order ID:'. $order_id.'<br>';
	
	// Getting an instance of the WC_Order object from a defined ORDER ID
$order = wc_get_order( $order_id ); 

// Iterating through each "line" items in the order      
foreach ($order->get_items() as $item_id => $item ) {

    // Get an instance of corresponding the WC_Product object
    $product        = $item->get_product();

    $active_price   = $product->get_price(); // The product active raw price

    $regular_price  = $product->get_sale_price(); // The product raw sale price

    $sale_price     = $product->get_regular_price(); // The product raw regular price

    $product_name   = $item->get_name(); // Get the item name (product name)

    $item_quantity  = $item->get_quantity(); // Get the item quantity

    $item_subtotal  = $item->get_subtotal(); // Get the item line total non discounted

    $item_subto_tax = $item->get_subtotal_tax(); // Get the item line total tax non discounted

    $item_total     = $item->get_total(); // Get the item line total discounted

    $item_total_tax = $item->get_total_tax(); // Get the item line total  tax discounted

    $item_taxes     = $item->get_taxes(); // Get the item taxes array

    $item_tax_class = $item->get_tax_class(); // Get the item tax class

    $item_tax_status= $item->get_tax_status(); // Get the item tax status

    $item_downloads = $item->get_item_downloads(); // Get the item downloads

    // Displaying this data (to check)
    $html .=  'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 ).'<br>';
}
	$html .= 'Order Total : '.  $order->get_total();
	// Print text using writeHTMLCell()
	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	// ---------------------------------------------------------

	// Close and output PDF document
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('Invoice_Order_'.$order_id.'.pdf', 'D');
	wp_die();
}