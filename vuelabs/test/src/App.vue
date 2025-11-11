<script setup>
import { ref, reactive, computed } from "vue";

const author = reactive({
  name: "John Doe",
  books: [
    "Vue 2 - Advanced Guide",
    "Vue 3 - Basic Guide",
    "Vue 4 - The Mystery",
  ],
  count: 2,
});
const href = ref("http://sisia.ir");
const activeColor = ref("red");
const fontSize = ref(30);
const awsome = ref("A");

// a computed ref
const publishedBooksMessage = computed(() => {
  return author.count;
});
</script>

<template>
  <header><h1>hi</h1></header>

  <span>{{ publishedBooksMessage }}</span>
  <h3 v-for="value in author.books" style="margin-bottom: 10px">
    {{ value }} <br />
  </h3>
  <!-- <br /> -->
  <button @click="awsome = 'B'">click B</button>
  <button @click="awsome = 'C'">click C</button>
  <h1 v-if="awsome === 'A'">oh A</h1>
  <h1 v-else-if="awsome === 'B'">oh B</h1>
  <h1 v-else-if="awsome === 'C'">oh C</h1>
  <h1 v-else>oh no</h1>
  <div :style="{ display: ['-webkit-box', '-ms-flexbox', 'flex'] }">fd</div>
  <main>
    <a v-bind:href>sisia</a>
  </main>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
