<script setup lang="ts">
import { RouterView } from 'vue-router';
</script>

<template>
  <header class="wof-header">
    <h1 class="puik-brand-jumbotron wof-title">MEET our community Heroes</h1>
    <p class="puik-body-default wof-description">
      From day one, PrestaShop has thrived as an open-source platform powered by a talented community of developers, merchants, and contributors.
      We all work together to improve and support the scalability of the PrestaShop e-commerce platform.
      By remaining the main contributors to its development, PrestaShop ensures long-term sustainability for everyone in the ecosystem.
      The project grows with each contribution, and with each contribution our contributors’ expertise grows.
      Take a look at our community.
    </p>
    <div class="contrib-kpis__container">
      <div class="contrib-kpis__item">
        <span class="contrib-kpis__value puik-brand-h1">16,723</span>
        <span class="contrib-kpis__label puik-body-default">Contribs by PrestaShop</span>
      </div>
      <div class="contrib-kpis__item">
        <span class="contrib-kpis__value puik-brand-h1">87%</span>
        <span class="contrib-kpis__label puik-body-default">Contribs by PrestaShop</span>
      </div>
      <div class="contrib-kpis__item">
        <span class="contrib-kpis__value puik-brand-h1">13%</span>
        <span class="contrib-kpis__label puik-body-default">Contribs by Community</span>
      </div>
    </div>
  </header>

  <RouterView />
</template>

<style scoped>
.wof-title {
  text-transform: uppercase;
  text-align: center;
}
.wof-description {
  text-align: center;
}
.wof-header {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 2rem;
  background-color: #1D1D1B;
  padding: 1rem;
}
@media (min-width: 768px) {
  .wof-header {
    padding: 4rem;
  }
}
.wof-header * {
  color: white;
}
.contrib-kpis__container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2rem;
  flex-wrap: wrap;
}
.contrib-kpis__item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-width: 190px;

}
</style>
