var ProductService = {
  init: function () {
    $("#addProductForm").validate({
      submitHandler: function (form) {
        var product = Object.fromEntries(new FormData(form).entries());
        ProductService.addProduct(product);
        form.reset();
      },
    });

    $("#editProductForm").validate({
      submitHandler: function (form) {
        var product = Object.fromEntries(new FormData(form).entries());
        ProductService.editProduct(product);
      },
    });

    ProductService.getAllProducts();
  },

  openAddModal: function () {
    $('#addProductModal').modal('show');
  },

  closeModal: function () {
    $('#editProductModal').modal('hide');
    $('#deleteProductModal').modal('hide');
    $('#addProductModal').modal('hide');
  },

  addProduct: function (product) {
    $.blockUI({ message: '<h3>Processing...</h3>' });
    RestClient.post('products', product, function(response){
      toastr.success("Product added successfully");
      $.unblockUI();
      ProductService.getAllProducts();
      ProductService.closeModal();
    }, function(response){
      $.unblockUI();
      toastr.error(response.responseText || 'Error adding product');
      ProductService.closeModal();
    });
  },

  getAllProducts: function () {
    RestClient.get("products", function (data) {
      Utils.datatable('products-table', [
        { data: 'name', title: 'Name' },
        { data: 'price', title: 'Price' },
        { data: 'description', title: 'Description' },
        {
          title: 'Actions',
          render: function (data, type, row, meta) {
            const rowStr = encodeURIComponent(JSON.stringify(row));
            return `
              <div class="d-flex justify-content-center gap-2 mt-3">
                <button class="btn btn-primary" onclick="ProductService.openEditModal('${row.id}')">Edit</button>
                <button class="btn btn-danger" onclick="ProductService.openConfirmationDialog(decodeURIComponent('${rowStr}'))">Delete</button>
              </div>
            `;
          }
        }
      ], data, 10);
    }, function (xhr, status, error) {
      console.error('Error fetching products:', error);
    });
  },

  getProductById: function (id) {
    RestClient.get('products/' + id, function (data) {
      $('input[name="id"]').val(data.id);
      $('input[name="name"]').val(data.name);
      $('input[name="price"]').val(data.price);
      $('textarea[name="description"]').val(data.description);
      $.unblockUI();
    }, function (xhr, status, error) {
      console.error('Error fetching product by id');
      $.unblockUI();
    });
  },

  openEditModal: function (id) {
    $.blockUI({ message: '<h3>Loading...</h3>' });
    ProductService.getProductById(id);
    $('#editProductModal').modal('show');
  },

  editProduct: function (product) {
    $.blockUI({ message: '<h3>Saving...</h3>' });
    RestClient.patch('products/' + product.id, product, function (data) {
      $.unblockUI();
      toastr.success("Product updated successfully");
      ProductService.closeModal();
      ProductService.getAllProducts();
    }, function (xhr, status, error) {
      console.error('Error updating product');
      $.unblockUI();
    });
  },

  openConfirmationDialog: function (product) {
    product = JSON.parse(product);
    $("#deleteProductModal").modal("show");
    $("#delete-product-body").html(`Are you sure you want to delete <strong>${product.name}</strong>?`);
    $("#delete_product_id").val(product.id);
  },

  deleteProduct: function () {
    $.blockUI({ message: '<h3>Deleting...</h3>' });
    RestClient.delete('products/' + $("#delete_product_id").val(), null, function(response){
      $.unblockUI();
      toastr.success(response.message || "Product deleted successfully");
      ProductService.closeModal();
      ProductService.getAllProducts();
    }, function(response){
      $.unblockUI();
      toastr.error(response.responseText || "Error deleting product");
      ProductService.closeModal();
    });
  }
};
