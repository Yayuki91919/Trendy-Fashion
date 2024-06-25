$(document).ready(function() {
    var sizeIndex = 2;
    var colorIndex = 2;

    $('#addSizeColorButton').click(function() {
        console.log("in script");
        var newRow = `
            <div class="card mb-3 size-row" id="row_${sizeIndex}">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="size">Size:</label>
                            <input type="text" name="sizes[${sizeIndex}][name]" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Colors:</label>
                            <div class="colors-container" id="row_${sizeIndex}_colors">
                                <div class="form-row align-items-center mt-2 color-group">
                                    <div class="col-md-5">
                                        <input type="text" name="sizes[${sizeIndex}][colors][1][name]" class="form-control" placeholder="Color" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="sizes[${sizeIndex}][colors][1][quantity]" class="form-control" placeholder="Quantity" required>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button type="button" class="removeColorButton btn btn-outline-danger">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="addColorButton btn btn-secondary mt-2">Add Color</button>
                        </div>
                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                            <button type="button" class="removeRowButton btn btn-danger">Remove Size</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#sizeColorRows').append(newRow);
        sizeIndex++;
    });

    $(document).on('click', '.addColorButton', function() {
        var parent = $(this).closest('.size-row');
        var rowId = parent.attr('id');
        var colorsContainer = parent.find('.colors-container');
        var newColorGroup = `
            <div class="form-row align-items-center mt-2 color-group">
                <div class="col-md-5">
                    <input type="text" name="${rowId}_colors[${colorIndex}][name]" class="form-control" placeholder="Color" required>
                </div>
                <div class="col-md-5">
                    <input type="number" name="${rowId}_colors[${colorIndex}][quantity]" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="removeColorButton btn btn-outline-danger">Remove</button>
                </div>
            </div>
        `;
        colorsContainer.append(newColorGroup);
        colorIndex++;
    });

    $(document).on('click', '.removeColorButton', function() {
        $(this).closest('.color-group').remove();
    });

    $(document).on('click', '.removeRowButton', function() {
        $(this).closest('.size-row').remove();
    });
});
