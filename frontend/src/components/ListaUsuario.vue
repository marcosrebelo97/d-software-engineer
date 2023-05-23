<template>
  <div>
    <h3>Seja bem-vindo!</h3>
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoUsuario">
      Cadastra-se
    </button>
    <br />
    <br />
    <br />
    <div v-if="visible">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Idade</th>
            <th scope="col">Email</th>
            <th scope="col">CEP</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usuario in usuario" :key="usuario.id">
            <th scope="row">{{ usuario.id }}</th>
            <td>{{ usuario.nome }}</td>
            <td>{{ usuario.idade }}</td>
            <td>{{ usuario.email }}</td>
            <td>{{ usuario.cep }}</td>
            <td>
              <button @click="edit(usuario)" data-toggle="modal" data-target="#editarUsuario" class="btn btn-info">Editar</button>
              <button @click="remove(usuario)" class="btn btn-danger">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

<!-- Modal Novo usuario -->
<div class="modal fade"   id="novoUsuario" tabindex="-1" role="dialog" aria-labelledby="novoUsuario" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="novoUsuario">Novo Usuário</h5>
      </div>
      <div class="modal-body">
        <Usuario v-on:close="fecharModal" />
      </div>
      <div class="modal-footer">
        <button type="button" id="fechar" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div v-if="show" class="modal fade"  id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="editarUsuario" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarUsuario">Editar Usuario</h5>
      </div>
      <div class="modal-body">
        <Editar v-bind:usuario="usuario"  v-on:close="fecharModalEdicao" />
      </div>
      <div class="modal-footer">
        <button type="button" id="fecharEdicao" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</template>

<script>
import { Axios } from './common/http-common'
import Usuario from './Usuario.vue'
import Editar from './EditarUsuario.vue'

export default {
  components: {
    Usuario: Usuario,
    Editar: Editar
  },
  data () {
    return {
      usuarios: [],
      visible: false,
      show: false,
      usuario: ''
    }
  },
  mounted () {
    this.listarUsuarios()
  },
  methods: {
    edit (usuarioToEdit) {
      this.usuario = usuarioToEdit
      this.show = true
    },
    fecharModalEdicao () {
      var botao = document.getElementById('fecharEdicao')
      botao.click()
      this.listarUsuarios()
    },
    fecharModal () {
      var botao = document.getElementById('fechar')
      botao.click()
      this.listarUsuarios()
    },
    listarUsuarios () {
      Axios.get('/users')
        .then(response => {
          this.usuarios = response.data
          this.visible = true
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<style>
</style>
