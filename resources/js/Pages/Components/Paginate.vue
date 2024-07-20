<template>
  <div class="flex items-center py-2">
    <button
      @click="prevPage"
      :disabled="!pagination.prev_page_url"
      class="bg-gray-500 text-white px-4 py-2 rounded"
    >
      Previous
    </button>
    <div class="flex space-x-2 mx-4">
      <button
        v-for="page in visiblePages"
        :key="page"
        @click="goToPage(page)"
        :class="['px-4 py-2 rounded', { 'bg-blue-500 text-white': page === pagination.current_page, 'bg-gray-500 text-white': page !== pagination.current_page }]"
      >
        {{ page }}
      </button>
    </div>
    <button
      @click="nextPage"
      :disabled="!pagination.next_page_url"
      class="bg-gray-500 text-white px-4 py-2 rounded"
    >
      Next
    </button>
  </div>
</template>

<script>
export default {
  props: {
    pagination: {
      type: Object,
      required: true,
    },
    fetchData: {
      type: Function,
      required: true,
    }
  },
  computed: {
    visiblePages() {
      const total = this.pagination.last_page;
      const current = this.pagination.current_page;
      const pages = [];

      if (total <= 3) {
        for (let i = 1; i <= total; i++) {
          pages.push(i);
        }
      } else {
        if (current <= 2) {
          pages.push(1, 2, 3);
        } else if (current >= total - 1) {
          pages.push(total - 2, total - 1, total);
        } else {
          pages.push(current - 1, current, current + 1);
        }
      }

      return pages;
    }
  },
  methods: {
    nextPage() {
      if (this.pagination.next_page_url) {
        this.fetchData(this.pagination.next_page_url);
      }
    },
    prevPage() {
      if (this.pagination.prev_page_url) {
        this.fetchData(this.pagination.prev_page_url);
      }
    },
    goToPage(page) {
      const url = `${this.pagination.path}?page=${page}`;
      this.fetchData(url);
    }
  }
};
</script>
