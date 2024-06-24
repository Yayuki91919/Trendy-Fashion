// $(document).ready(function () {
//     var rowCount = 1;

//     // Function to add a new size and color row
//     $('#addSizeColorButton').click(function () {
//         rowCount++;
//         var rowId = 'row_' + rowCount;

//         var row = `
//             <div class="row size-row" id="${rowId}" style="margin-top: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
//                 <div class="col-sm-3">
//                     <label for="${rowId}_size">Size:</label>
//                     <input type="text" id="${rowId}_size" name="sizes[${rowCount}][name]" class="form-control mb-2" style="width: 100%;" required>
//                 </div>
//                 <div class="col-sm-6">
//                     <label>Colors:</label>
//                     <div class="colors-container" id="${rowId}_colors">
//                         <div class="color-group" style="margin-top: 5px; display: flex; align-items: center;">
//                             <input type="text" name="sizes[${rowCount}][colors][1][name]" class="form-control" placeholder="Color" style="width: 50%; display: inline-block;" required>
//                             <input type="number" name="sizes[${rowCount}][colors][1][quantity]" class="form-control" placeholder="Quantity" style="width: 40%; display: inline-block; margin-left: 10px;" required>
//                             <button type="button" class="removeColorButton btn btn-outline-danger ml-2">Remove Color</button>
//                         </div>
//                     </div>
//                     <button type="button" class="addColorButton btn btn-secondary mt-2">Add Color</button>
//                 </div>
//                 <div class="col-sm-2">
//                     <button type="button" class="removeRowButton btn btn-danger mt-2">Remove Size</button>
//                 </div>
//             </div>
//         `;

//         $('#sizeColorRows').append(row);
//     });

//     // Function to remove a size row
//     $('#sizeColorRows').on('click', '.removeRowButton', function () {
//         if ($('#sizeColorRows .size-row').length > 1) {
//             $(this).closest('.size-row').remove();
//         }
//     });

//     // Function to add a new color for a size row
//     $('#sizeColorRows').on('click', '.addColorButton', function () {
//         var rowId = $(this).closest('.size-row').attr('id');
//         var colorGroup = `
//             <div class="color-group" style="margin-top: 5px; display: flex; align-items: center;">
//                 <input type="text" name="sizes[${rowId}][colors][${$('#' + rowId + '_colors .color-group').length + 1}][name]" class="form-control" placeholder="Color" required>
//                 <input type="number" name="sizes[${rowId}][colors][${$('#' + rowId + '_colors .color-group').length + 1}][quantity]" class="form-control ml-2" placeholder="Quantity" required>
//                 <button type="button" class="removeColorButton btn btn-outline-danger ml-2">Remove Color</button>
//             </div>
//         `;

//         $('#' + rowId + '_colors').append(colorGroup);
//     });

//     // Function to remove a color from a size row
//     $('#sizeColorRows').on('click', '.removeColorButton', function () {
//         var colorGroupCount = $(this).closest('.colors-container').find('.color-group').length;
//         if (colorGroupCount > 1) {
//             $(this).closest('.color-group').remove();
//         }
//     });

//     // Function to handle form submission via AJAX
//     $('#productForm').submit(function (event) {
//         event.preventDefault();

//         var formData = new FormData(this);

//         $.ajax({
//             url: 'process_form.php',
//             type: 'POST',
//             data: formData,
//             processData: false,
//             contentType: false,
//             success: function (response) {
//                 console.log('Form submitted successfully');
//                 // Optionally, handle success response here
//             },
//             error: function (xhr, status, error) {
//                 console.error('Form submission error:', error);
//                 // Optionally, handle error here
//             }
//         });
//     });
// });
$(document).ready(function () {
    var rowCount = 1;

    // Function to add a new size and color row
    $('#addSizeColorButton').click(function () {
        rowCount++;
        var rowId = 'row_' + rowCount;

        var row = `
            <div class="row size-row" id="${rowId}" style="margin-top: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <div class="col-sm-3">
                    <label for="${rowId}_size">Size:</label>
                    <input type="text" id="${rowId}_size" name="sizes[${rowCount}][name]" class="form-control mb-2 size-name" style="width: 100%;" required>
                </div>
                <div class="col-sm-6">
                    <label>Colors:</label>
                    <div class="colors-container" id="${rowId}_colors">
                        <div class="color-group" style="margin-top: 5px; display: flex; align-items: center;">
                            <input type="text" name="sizes[${rowCount}][colors][1][name]" class="form-control color-name" placeholder="Color" style="width: 50%; display: inline-block;" required>
                            <input type="number" name="sizes[${rowCount}][colors][1][quantity]" class="form-control color-quantity" placeholder="Quantity" style="width: 40%; display: inline-block; margin-left: 10px;" required>
                            <button type="button" class="removeColorButton btn btn-outline-danger ml-2">Remove Color</button>
                        </div>
                    </div>
                    <button type="button" class="addColorButton btn btn-secondary mt-2">Add Color</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="removeRowButton btn btn-danger mt-2">Remove Size</button>
                </div>
            </div>
        `;

        $('#sizeColorRows').append(row);
    });

    // Function to remove a size row
    $('#sizeColorRows').on('click', '.removeRowButton', function () {
        if ($('#sizeColorRows .size-row').length > 1) {
            $(this).closest('.size-row').remove();
        }
    });

    // Function to add a new color for a size row
    $('#sizeColorRows').on('click', '.addColorButton', function () {
        var rowId = $(this).closest('.size-row').attr('id');
        var colorGroup = `
            <div class="color-group" style="margin-top: 5px; display: flex; align-items: center;">
                <input type="text" name="sizes[${rowId}][colors][${$('#' + rowId + '_colors .color-group').length + 1}][name]" class="form-control color-name" placeholder="Color" required>
                <input type="number" name="sizes[${rowId}][colors][${$('#' + rowId + '_colors .color-group').length + 1}][quantity]" class="form-control color-quantity" placeholder="Quantity" required>
                <button type="button" class="removeColorButton btn btn-outline-danger ml-2">Remove Color</button>
            </div>
        `;

        $('#' + rowId + '_colors').append(colorGroup);
    });

    // Function to remove a color from a size row
    $('#sizeColorRows').on('click', '.removeColorButton', function () {
        var colorGroupCount = $(this).closest('.colors-container').find('.color-group').length;
        if (colorGroupCount > 1) {
            $(this).closest('.color-group').remove();
        }
    });
});
