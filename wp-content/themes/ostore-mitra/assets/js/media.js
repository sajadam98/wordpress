jQuery(function($){
  // Set all variables to be used in scope
  var frame;
  
  // ADD IMAGE LINK
  $(document).on('click','.category_background', function( event ) {
    imgContainer = $(this).closest('.widget').find('.bg-img-container');
    imgIdInput = $(this).closest('.widget').find('.background-img-id');

    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Select or Upload Image For Title  Background',
      button: {
        text: 'Select'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    
    // When an image is selected in the media frame...
    // $(document).on( 'select', 'frame' ,function() {
    frame.on('select',function(){
      // Get media attachment details from the frame state
      var attachment = frame.state().get('selection').first().toJSON();
      
      imgContainer.show();
      // Send the attachment URL to our custom image input field.
      imgContainer.html( '<img src="'+attachment.url+'" alt="" style="max-height:200px;"/>' );

      // Send the attachment id to our hidden input
      imgIdInput.val( attachment.id );

      // Hide the add image link
      // $('.category_background').addClass( 'hidden' );

      // Unhide the remove image link
      // delImgLink.removeClass( 'hidden' );
    });

    // Finally, open the modal on click
    frame.open();
  });

    // Remove IMAGE LINK
    $(document).on('click','.category_background_remove', function( event ) {
      imgContainer = $(this).closest('.widget').find('.bg-img-container');
      imgIdInput = $(this).closest('.widget').find('.background-img-id');
      imgContainer.attr('src', "");
      imgContainer.hide();
      imgIdInput.val('');
    });
});
