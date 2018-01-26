<div id="example-2">
  <!-- `greet` é o nome de um método definido abaixo -->
  <button v-on:click="greet">Cumprimentar</button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.5/vue.min.js"></script>
<script>
var example2 = new Vue({
el: '#example-2',
data: {
name: 'Diego'
},
mounted() {
           alert('ff');
           //his.getMatches();
       },
// define métodos dentro do objeto `methods`
methods: {
greet: function (event) {
  // `this` dentro de métodos aponta para a instância Vue
  alert('Olá ' + this.name + '!')
  // `event` é o evento DOM nativo
  if (event) {
    alert(event.target.tagName)
  }
}
},

})
</script>
