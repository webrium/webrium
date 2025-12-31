import { createApp, reactive, ref, computed } from 'zogjs';

/**
 * Admin Panel Application
 * Handles sidebar toggle, theme switching, and global admin state
 */

createApp(() => {
  // Admin global state
  const adminState = reactive({
    sidebarOpen: false,
    currentPage: window.location.pathname,
    notifications: [],
    unreadCount: 0
  });

  // User state
  const user = reactive({
    name: 'Admin',
    email: 'admin@example.com',
    avatar: 'https://ui-avatars.com/api/?name=Admin&background=4f46e5&color=fff',
    role: 'Administrator'
  });

  // Theme state
  const theme = ref(localStorage.getItem('theme') || 'light');

  // Computed properties
  const hasUnreadNotifications = computed(() => adminState.unreadCount > 0);

  /**
   * Toggle sidebar on mobile
   */
  function toggleSidebar() {
    adminState.sidebarOpen = !adminState.sidebarOpen;
  }

  /**
   * Close sidebar (useful for mobile when navigating)
   */
  function closeSidebar() {
    adminState.sidebarOpen = false;
  }

  /**
   * Toggle theme between light and dark
   */
  function toggleTheme() {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    localStorage.setItem('theme', theme.value);
    document.documentElement.setAttribute('data-theme', theme.value);
  }

  /**
   * Check if a route is active
   */
  function isActiveRoute(route) {
    return adminState.currentPage === route || 
           adminState.currentPage.startsWith(route + '/');
  }

  /**
   * Add notification
   */
  function addNotification(notification) {
    adminState.notifications.push({
      id: Date.now(),
      ...notification,
      read: false,
      timestamp: new Date().toISOString()
    });
    adminState.unreadCount++;
  }

  /**
   * Mark notification as read
   */
  function markAsRead(notificationId) {
    const notification = adminState.notifications.find(n => n.id === notificationId);
    if (notification && !notification.read) {
      notification.read = true;
      adminState.unreadCount = Math.max(0, adminState.unreadCount - 1);
    }
  }

  /**
   * Clear all notifications
   */
  function clearNotifications() {
    adminState.notifications = [];
    adminState.unreadCount = 0;
  }

  /**
   * Format date for display
   */
  function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    
    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
    
    const diffHours = Math.floor(diffMins / 60);
    if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    
    const diffDays = Math.floor(diffHours / 24);
    if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    
    return date.toLocaleDateString();
  }

  /**
   * Initialize theme on mount
   */
  document.documentElement.setAttribute('data-theme', theme.value);

  // Sample notifications for demo
  setTimeout(() => {
    addNotification({
      type: 'success',
      title: 'New Order',
      message: 'Order #1234 has been placed'
    });
  }, 1000);

  setTimeout(() => {
    addNotification({
      type: 'warning',
      title: 'Low Stock',
      message: 'Screen Protector is out of stock'
    });
  }, 2000);

  return {
    adminState,
    user,
    theme,
    hasUnreadNotifications,
    toggleSidebar,
    closeSidebar,
    toggleTheme,
    isActiveRoute,
    addNotification,
    markAsRead,
    clearNotifications,
    formatDate
  };
}).mount('#app');