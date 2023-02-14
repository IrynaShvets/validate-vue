<template>
  <div>
    <FormApp />
  </div>
</template>

<script>
import FormApp from './components/FormApp.vue'

export default {
  name: 'App',
  components: {
    FormApp
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
