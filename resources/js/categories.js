import { createApp, reactive, ref, computed, nextTick } from 'zogjs';
import { ZogHttpPlugin, $http } from '@zogjs/http';

/**
 * Categories Management Application
 */

createApp(() => {
  // State
  const categories = reactive([]);
  const filteredCategories = reactive([]);
  const selectedIds = reactive([]);
  const parentCategories = reactive([]);

  const searchQuery = ref('');
  const statusFilter = ref('');
  const parentFilter = ref('');
  const sortBy = ref('order');

  const currentPage = ref(1);
  const perPage = ref(10);
  const totalCategories = ref(0);

  const categoryToDelete = reactive({
    id: null,
    name: '',
    hasChildren: false
  });

  // Form state
  const formData = reactive({
    id: null,
    name: '',
    slug: '',
    description: '',
    parent_id: '',
    image: '',
    icon: '',
    status: 'active',
    order: 0,
    meta_title: '',
    meta_description: '',
    meta_keywords: ''
  });

  const errors = reactive({});
  const isSubmitting = ref(false);
  const imagePreview = ref('');

  const showSuccessToast = ref(false);
  const showErrorToast = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');

  // Computed
  const totalPages = computed(() => Math.ceil(totalCategories.value / perPage.value));

  const getCategorys = async () => {
    const { data } = await $http.post('', {});
    console.log(data);
  }

  getCategorys()
  /**
   * Initialize categories list
   */
  function initCategoriesList() {
    // Get categories from page data
    // const categoriesData = window.categoriesData || [];
    // categories.splice(0, categories.length, ...categoriesData);
    // filteredCategories.splice(0, filteredCategories.length, ...categoriesData);
    // totalCategories.value = categoriesData.length;
  }

  /**
   * Initialize category form
   */
  function initCategoryForm() {
    // Get form data from page
    const categoryData = window.categoryData || null;
    const parentsData = window.parentCategoriesData || [];

    if (categoryData) {
      Object.assign(formData, categoryData);
    }

    parentCategories.splice(0, parentCategories.length, ...parentsData);
  }

  /**
   * Search categories
   */
  function searchCategories() {
    filterCategories();
  }

  /**
   * Filter categories based on search and filters
   */
  function filterCategories() {
    let filtered = [];

    // Search filter
    if (searchQuery.value) {
      const query = searchQuery.value.toLowerCase();
      filtered = categories.filter(cat =>
        cat.name.toLowerCase().includes(query) ||
        cat.slug.toLowerCase().includes(query) ||
        (cat.description && cat.description.toLowerCase().includes(query))
      );
    }

    // Status filter
    if (statusFilter.value) {
      filtered = filtered.filter(cat => cat.status === statusFilter.value);
    }

    console.log(parentFilter.value);
    
    // Parent filter
    if (parentFilter.value === 'root') {
      filtered = filtered.filter(cat => !cat.parent_id);
    } else if (parentFilter.value === 'child') {
      filtered = filtered.filter(cat => cat.parent_id);
    }

    // Sort
    sortCategoriesArray(filtered);

    console.log(filtered,searchQuery.value);
    
    filteredCategories.splice(0, filteredCategories.length);
    filtered.forEach(f=>{
      console.log(f,filterCategories);
      
      filteredCategories.push(f)
    })
    totalCategories.value = filtered.length;
    currentPage.value = 1;
  }

  /**
   * Sort categories
   */
  function sortCategories() {
    const sorted = [...filteredCategories];
    sortCategoriesArray(sorted);
    filteredCategories.splice(0, filteredCategories.length, ...sorted);
  }

  /**
   * Sort array helper
   */
  function sortCategoriesArray(array) {
    array.sort((a, b) => {
      switch (sortBy.value) {
        case 'name':
          return a.name.localeCompare(b.name);
        case 'created_at':
          return new Date(b.created_at) - new Date(a.created_at);
        case 'updated_at':
          return new Date(b.updated_at) - new Date(a.updated_at);
        case 'order':
        default:
          return a.order - b.order;
      }
    });
  }

  /**
   * Toggle select all
   */
  function toggleSelectAll(event) {
    if (event.target.checked) {
      selectedIds.splice(0, selectedIds.length, ...filteredCategories.map(c => c.id));
    } else {
      selectedIds.splice(0, selectedIds.length);
    }
  }

  /**
   * Delete category
   */
  function deleteCategory(id, name) {
    categoryToDelete.id = id;
    categoryToDelete.name = name;
    categoryToDelete.hasChildren = categories.some(c => c.parent_id === id);

    document.getElementById('delete_modal').showModal();
  }

  /**
   * Close delete modal
   */
  function closeDeleteModal() {
    document.getElementById('delete_modal').close();
  }

  /**
   * Confirm delete
   */
  async function confirmDelete() {
    try {
      const response = await fetch(`/admin/categories/${categoryToDelete.id}/delete`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });

      const data = await response.json();

      if (data.success) {
        // Remove from list
        const index = categories.findIndex(c => c.id === categoryToDelete.id);
        if (index > -1) {
          categories.splice(index, 1);
        }

        filterCategories();
        showToast('success', data.message);
        closeDeleteModal();
      } else {
        showToast('error', data.message);
      }
    } catch (error) {
      console.error('Delete error:', error);
      showToast('error', 'Failed to delete category');
    }
  }

  /**
   * Bulk action
   */
  async function bulkAction(action) {
    if (selectedIds.length === 0) return;

    const confirmed = confirm(`Are you sure you want to ${action} ${selectedIds.length} categories?`);
    if (!confirmed) return;

    try {
      const response = await fetch('/admin/categories/bulk-action', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          action: action,
          ids: selectedIds
        })
      });

      const data = await response.json();

      if (data.success) {
        showToast('success', data.message);
        // Reload page to see changes
        setTimeout(() => window.location.reload(), 1500);
      } else {
        showToast('error', data.message);
      }
    } catch (error) {
      console.error('Bulk action error:', error);
      showToast('error', 'Failed to perform bulk action');
    }
  }

  /**
   * Pagination
   */
  function previousPage() {
    if (currentPage.value > 1) {
      currentPage.value--;
    }
  }

  function nextPage() {
    if (currentPage.value < totalPages.value) {
      currentPage.value++;
    }
  }

  /**
   * Format date
   */
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    });
  }

  /**
   * Generate slug from name
   */
  function generateSlug() {
    if (!formData.slug || formData.slug === '') {
      formData.slug = formData.name
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    }
  }

  /**
   * Handle image upload
   */
  function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Validate file size (2MB)
    if (file.size > 2 * 1024 * 1024) {
      showToast('error', 'Image size must be less than 2MB');
      event.target.value = '';
      return;
    }

    // Validate file type
    if (!file.type.startsWith('image/')) {
      showToast('error', 'Please select an image file');
      event.target.value = '';
      return;
    }

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
      formData.image = e.target.result; // Store base64 or handle upload
    };
    reader.readAsDataURL(file);
  }

  /**
   * Remove image
   */
  function removeImage() {
    formData.image = '';
    imagePreview.value = '';
  }

  /**
   * Submit form
   */
  async function submitForm(event) {
    event.preventDefault();

    if (isSubmitting.value) return;

    // Clear previous errors
    Object.keys(errors).forEach(key => delete errors[key]);

    // Validate
    if (!formData.name) {
      errors.name = 'Category name is required';
      return;
    }

    if (!formData.slug) {
      errors.slug = 'Slug is required';
      return;
    }

    isSubmitting.value = true;

    try {
      const url = formData.id
        ? `/admin/categories/${formData.id}/update`
        : '/admin/categories';

      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      const data = await response.json();

      if (data.success) {
        showToast('success', data.message);

        if (data.redirect) {
          setTimeout(() => {
            window.location.href = data.redirect;
          }, 1500);
        }
      } else {
        if (data.errors) {
          Object.assign(errors, data.errors);
        }
        showToast('error', data.message || 'Validation failed');
      }
    } catch (error) {
      console.error('Submit error:', error);
      showToast('error', 'Failed to save category');
    } finally {
      isSubmitting.value = false;
    }
  }

  /**
   * Reset form
   */
  function resetForm() {
    Object.assign(formData, {
      name: '',
      slug: '',
      description: '',
      parent_id: '',
      image: '',
      icon: '',
      status: 'active',
      order: 0,
      meta_title: '',
      meta_description: '',
      meta_keywords: ''
    });
    imagePreview.value = '';
    Object.keys(errors).forEach(key => delete errors[key]);
  }

  /**
   * Show toast notification
   */
  function showToast(type, message) {
    if (type === 'success') {
      successMessage.value = message;
      showSuccessToast.value = true;
      setTimeout(() => {
        showSuccessToast.value = false;
      }, 3000);
    } else {
      errorMessage.value = message;
      showErrorToast.value = true;
      setTimeout(() => {
        showErrorToast.value = false;
      }, 3000);
    }
  }

  /**
   * Initialize based on current page
   */
  function init() {
    const path = window.location.pathname;

    if (path === '/admin/categories') {
      initCategoriesList();
    } else if (path.includes('/admin/categories/create') || path.includes('/admin/categories/edit')) {
      initCategoryForm();

      // Attach form submit handler
      const form = document.getElementById('category-form');
      if (form) {
        form.addEventListener('submit', submitForm);
      }
    }
  }

  // Initialize on mount
  init();

  return {
    // List state
    filteredCategories,
    selectedIds,
    searchQuery,
    statusFilter,
    parentFilter,
    sortBy,
    currentPage,
    perPage,
    totalCategories,
    totalPages,
    categoryToDelete,

    // Form state
    formData,
    errors,
    isSubmitting,
    imagePreview,
    parentCategories,
    showSuccessToast,
    showErrorToast,
    successMessage,
    errorMessage,

    // Methods
    searchCategories,
    filterCategories,
    sortCategories,
    toggleSelectAll,
    deleteCategory,
    closeDeleteModal,
    confirmDelete,
    bulkAction,
    previousPage,
    nextPage,
    formatDate,
    generateSlug,
    handleImageUpload,
    removeImage,
    resetForm
  };
}).use(ZogHttpPlugin).mount('#app');