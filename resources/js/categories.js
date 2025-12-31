import { createApp, reactive, ref, computed } from 'zogjs';
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
  
  const stats = reactive({
    total: 0,
    active: 0,
    inactive: 0,
    root: 0
  });
  
  const searchQuery = ref('');
  const statusFilter = ref('');
  const parentFilter = ref('');
  const sortBy = ref('order');
  
  const currentPage = ref(1);
  const perPage = ref(10);
  
  const isLoading = ref(false);
  const isSubmitting = ref(false);
  
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
  const imagePreview = ref('');
  
  const showSuccessToast = ref(false);
  const showErrorToast = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');

  // Computed
  const totalCategories = computed(() => filteredCategories.length);
  const totalPages = computed(() => Math.ceil(totalCategories.value / perPage.value));
  
  const paginatedCategories = computed(() => {
    const start = (currentPage.value - 1) * perPage.value;
    const end = start + perPage.value;
    return filteredCategories.slice(start, end);
  });

  /**
   * Get categories from API
   */
  const getCategories = async () => {
    try {
      isLoading.value = true;
      
      const response = await $http.post('/admin/categories', {});
      
      if (response.data.ok) {
        categories.splice(0, categories.length, ...response.data.categories);
        filteredCategories.splice(0, filteredCategories.length, ...response.data.categories);
        
        // Update stats
        Object.assign(stats, response.data.stats);
      }
    } catch (error) {
      console.error('Failed to load categories:', error);
      showToast('error', 'Failed to load categories');
    } finally {
      isLoading.value = false;
    }
  };

  /**
   * Get parent categories for form
   */
  const getParentCategories = async (excludeId = null) => {
    try {
      const response = await $http.post('/admin/categories/parents', {
        exclude_id: excludeId
      });
      
      if (response.data.ok) {
        parentCategories.splice(0, parentCategories.length, ...response.data.categories);
      }
    } catch (error) {
      console.error('Failed to load parent categories:', error);
    }
  };

  /**
   * Get single category for edit
   */
  const getCategory = async (id) => {
    console.log('getCategory');
    
    try {
      isLoading.value = true;
      
      const response = await $http.post(`/admin/categories/${id}`, {});
      
      if (response.data.ok) {
        Object.assign(formData, response.data.category);
        if (formData.image) {
          imagePreview.value = formData.image;
        }
      }
    } catch (error) {
      console.error('Failed to load category:', error);
      showToast('error', 'Failed to load category');
    } finally {
      isLoading.value = false;
    }
  };

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
    let filtered = [...categories];

    // Search filter
    if (searchQuery.value) {
      const query = searchQuery.value.toLowerCase();
      filtered = filtered.filter(cat => 
        cat.name.toLowerCase().includes(query) ||
        cat.slug.toLowerCase().includes(query) ||
        (cat.description && cat.description.toLowerCase().includes(query))
      );
    }

    // Status filter
    if (statusFilter.value) {
      filtered = filtered.filter(cat => cat.status === statusFilter.value);
    }

    // Parent filter
    if (parentFilter.value === 'root') {
      filtered = filtered.filter(cat => !cat.parent_id);
    } else if (parentFilter.value === 'child') {
      filtered = filtered.filter(cat => cat.parent_id);
    }

    // Sort
    sortCategoriesArray(filtered);

    filteredCategories.splice(0, filteredCategories.length, ...filtered);
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
   * Toggle single selection
   */
  function toggleSelection(id) {
    const index = selectedIds.indexOf(id);
    if (index > -1) {
      selectedIds.splice(index, 1);
    } else {
      selectedIds.push(id);
    }
  }

  /**
   * Delete category
   */
  function deleteCategory(id, name) {
    const category = categories.find(c => c.id === id);
    
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
      const response = await $http.post(`/admin/categories/${categoryToDelete.id}/delete`, {});

      if (response.data.ok) {
        // Remove from list
        const index = categories.findIndex(c => c.id === categoryToDelete.id);
        if (index > -1) {
          categories.splice(index, 1);
        }
        
        filterCategories();
        showToast('success', response.data.message);
        closeDeleteModal();
        
        // Refresh stats
        await getCategories();
      } else {
        showToast('error', response.data.message);
      }
    } catch (error) {
      console.error('Delete error:', error);
      showToast('error', error.response?.data?.message || 'Failed to delete category');
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
      const response = await $http.post('/admin/categories/bulk-action', {
        action: action,
        ids: selectedIds
      });

      if (response.data.ok) {
        showToast('success', response.data.message);
        selectedIds.splice(0, selectedIds.length);
        
        // Reload categories
        await getCategories();
      } else {
        showToast('error', response.data.message);
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
    if (!dateString) return '';
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
      formData.image = e.target.result;
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
   * Submit form (create or update)
   */
  async function submitForm(event) {
    event.preventDefault();
    
    if (isSubmitting.value) return;
    
    // Clear previous errors
    Object.keys(errors).forEach(key => delete errors[key]);
    
    // Client-side validation
    if (!formData.name.trim()) {
      errors.name = 'Category name is required';
      return;
    }
    
    if (!formData.slug.trim()) {
      errors.slug = 'Slug is required';
      return;
    }

    isSubmitting.value = true;

    try {
      const endpoint = formData.id 
        ? `/admin/categories/${formData.id}/update`
        : '/admin/categories/store';
      
      const response = await $http.post(endpoint, formData);

      if (response.data.ok) {
        showToast('success', response.data.message);
        
        // Redirect to list page
        setTimeout(() => {
          window.location.href = '/admin/categories';
        }, 1500);
      } else {
        if (response.data.errors) {
          Object.assign(errors, response.data.errors);
        }
        showToast('error', response.data.message || 'Validation failed');
      }
    } catch (error) {
      console.error('Submit error:', error);
      
      if (error.response?.data?.errors) {
        Object.assign(errors, error.response.data.errors);
      }
      
      showToast('error', error.response?.data?.message || 'Failed to save category');
    } finally {
      isSubmitting.value = false;
    }
  }

  /**
   * Reset form
   */
  function resetForm() {
    Object.assign(formData, {
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
  async function init() {
    const path = window.location.pathname;
    
    if (path === '/admin/categories') {
      // List page
      await getCategories();
    } else if (path.includes('/admin/categories/create')) {
      // Create page
      await getParentCategories();
      
      // Attach form submit handler
      const form = document.getElementById('category-form');
      if (form) {
        form.addEventListener('submit', submitForm);
      }
    } else if (path.includes('/admin/categories/edit/')) {
      // Edit page
      const id = parseInt(path.split('/').pop());
      
      await getParentCategories(id);
      await getCategory(id);
      
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
    categories,
    filteredCategories,
    paginatedCategories,
    selectedIds,
    stats,
    searchQuery,
    statusFilter,
    parentFilter,
    sortBy,
    currentPage,
    perPage,
    totalCategories,
    totalPages,
    categoryToDelete,
    isLoading,

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
    getCategories,
    searchCategories,
    filterCategories,
    sortCategories,
    toggleSelectAll,
    toggleSelection,
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
    submitForm,
    resetForm
  };
})
.use(ZogHttpPlugin, { baseURL: '' })
.mount('#app');