<script setup lang="ts">
import 'vue3-carousel/carousel.css'

import { ref, onMounted } from 'vue'
import { type PuikTableHeader } from '@prestashopcorp/puik-components'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

interface Contributor {
  rank: number
  avatar: string
  name: string
  contributions: number
}

const expandable = ref(false)
const selection = ref([])
const selectable = ref(false)
const searchBar = ref(false)
const searchFromServer = ref(false)
const sortFromServer = ref(false)
const fullWidth = ref(true)
const stickyFirstCol = ref(false)
const stickyLastCol = ref(false)

const headers: PuikTableHeader[] = [
  {
    text: 'Rank',
    value: 'rank',
    size: 'sm',
    align: 'left',
    searchable: false,
  },
  {
    text: 'Avatar',
    value: 'avatar',
    size: 'sm',
    align: 'center',
    searchable: false,
  },
  {
    text: 'Name',
    value: 'name',
    size: 'md',
    searchable: true,
  },
  {
    text: 'Contributions',
    value: 'contributions',
    size: 'sm',
    align: 'center',
    searchable: false,
  },
  {
    value: 'actions',
    size: 'sm',
    align: 'center',
    preventExpand: true,
    searchSubmit: true,
  },
]

const carousel_config = {
  itemsToShow: 1,
  gap: 16,
  snapAlign: 'center' as const,
  breakpointMode: 'carousel' as const,
  breakpoints: {
    400: {
      itemsToShow: 2,
      snapAlign: 'start' as const,
    },
    500: {
      itemsToShow: 3,
      snapAlign: 'start' as const,
    },
    1200: {
      itemsToShow: 4,
      snapAlign: 'start' as const,
    },
    1600: {
      itemsToShow: 5,
      snapAlign: 'start' as const,
    },
  },
}

const images = Array.from({ length: 10 }, (_, index) => ({
  id: index + 1,
  url: `https://picsum.photos/seed/${Math.random()}/800/600`,
}))

const contributors = ref<Contributor[]>([])
const newContributors = ref([])

onMounted(async () => {
  try {
    const response = await fetch('https://contributors.prestashop-project.org/newcontributors.json')
    if (!response.ok) throw new Error('Erreur de chargement')
    const data = await response.json()
    newContributors.value = data
  } catch (error) {
    console.error('Erreur :', error)
  }

  const el = document.getElementById('vue-app')
  if (el && el.dataset.contributors) {
    contributors.value = JSON.parse(el.dataset.contributors)
  }
})
</script>

<template>
  <main>
    <section class="wof-section wof-top-contributors__section">
      <h2 class="puik-h1">PrestaShop Project’s top contributors</h2>
      <div class="wof-top-contributors__cards">
        <puik-card class="wof-top-contributors__card">
          <h3 class="puik-h2">🚀 Top companies</h3>
          <p class="puik-body-default">
            Meet the top companies who are helping us strengthen PrestaShop.
          </p>
          <puik-table
            v-if="contributors.length"
            v-model:selection="selection"
            :headers="headers"
            :items="contributors"
            :expandable="expandable"
            :selectable="selectable"
            :searchBar="searchBar"
            :searchFromServer="searchFromServer"
            :sortFromServer="sortFromServer"
            :fullWidth="fullWidth"
            :stickyFirstCol="stickyFirstCol"
            :stickyLastCol="stickyLastCol"
          >
            <template #item-avatar="{ item }">
              <puik-avatar type="photo" :src="item.avatar" />
            </template>
            <template #item-actions="{ item }">
              <puik-button variant="text" right-icon="visibility" aria-label="view profile" />
            </template>
          </puik-table>
        </puik-card>
        <puik-card class="wof-top-contributors__card">
          <h3 class="puik-h2">🔥 Top contributors</h3>
          <p class="puik-body-default">These experts spent hours improving PrestaShop's quality.</p>
          <puik-table
            v-if="contributors.length"
            v-model:selection="selection"
            :headers="headers"
            :items="contributors"
            :expandable="expandable"
            :selectable="selectable"
            :searchBar="searchBar"
            :searchFromServer="searchFromServer"
            :sortFromServer="sortFromServer"
            :fullWidth="fullWidth"
            :stickyFirstCol="stickyFirstCol"
            :stickyLastCol="stickyLastCol"
          >
            <template #item-avatar="{ item }">
              <puik-avatar type="photo" :src="item.avatar" />
            </template>
            <template #item-actions="{ item }">
              <puik-button variant="text" right-icon="visibility" aria-label="view profile" />
            </template>
          </puik-table>
        </puik-card>
      </div>
    </section>
    <section class="wof-section wof-new-contributors__section">
      <div>
        <h2 class="puik-h2">👋 Say hello to our new contributors</h2>
        <p class="puik-body-default">
          Fresh commits, fresh faces. Meet the contributors who just joined!
        </p>
        <div>

        </div>
        <Carousel v-bind="carousel_config">
          <Slide v-for="(newContributor, index) in newContributors" :key="index">
            <puik-card class="wof-new-contributors__card">
              <div>
                <img class="wof-new-contributors__img" :src="`https://picsum.photos/seed/1/800/600`" :alt="newContributor">
                <h3 class="puik-h3">{{ newContributor }}</h3>
                <p class="puik-body-default">{{ newContributor }} contributions</p>
              </div>
            </puik-card>
          </Slide>
          <template #addons>
            <Navigation />
          </template>
        </Carousel>
      </div>
    </section>
    <section class="wof-section wof-wall__section">
      <div>
        <h2 class="puik-h2">🏆 PrestaShop Project’s Wall of fame</h2>
        <p class="puik-body-default">
          The PrestaShop Wall of Fame: built by the best, committed to the core.
        </p>
      </div>
    </section>
    <section class="wof-section wof-contribute__section">
      <div class="wof-contribute__content">
        <h2 class="puik-h2">✨ How to contribute?</h2>
        <p class="puik-body-default">
          Join the open-source movement by contributing to PrestaShop on GitHub—whether it’s code,
          documentation, or ideas. Every contribution counts!
        </p>
      </div>
    </section>
  </main>
</template>

<style scoped>
.wof-section {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}
@media (min-width: 768px) {
  .wof-section {
    padding: 4rem;
  }
}
.wof-top-contributors__cards {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
}
.wof-top-contributors__card {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  max-width: 100%;
  gap: 0 !important;
}
.wof-new-contributors__section {
  background-color: #a4dbe8;
}
.wof-wall__section {
}
.wof-contribute__section {
  background-color: #bde9c9;
}
.wof-contribute__content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.wof-new-contributors__card {
  flex-grow: 1;
}
.wof-new-contributors__img {
  width: 100%;
  height: 166px;
  object-fit: cover;
  object-position: center;
}
</style>
