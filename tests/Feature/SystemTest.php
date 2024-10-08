<?php

namespace Tests\Feature;

use App\Models\Tarefa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_tarefa_crud(){
        $tarefa = Tarefa::create([
            'titulo' => 'Nova tarefa',
            'descricao' => 'Tarefa de teste',
            'concluida' => false
        ]);

        //Esse método verifica se há uma entrada específica no banco de dados
        $this->assertDatabaseHas('tarefas', ['titulo' => 'Nova tarefa']); 

        //Read
        $tarefaRecuperada = Tarefa::find($tarefa->id);
        $this->assertEquals('Nova tarefa', $tarefaRecuperada->titulo);
        $this->assertEquals('Tarefa de teste', $tarefaRecuperada->descricao);

        //Update
        $tarefaRecuperada->update(['titulo' => 'Tarefa atualizada']);
        $this->assertEquals('Tarefa atualizada', $tarefaRecuperada->titulo);

        //Delete
        $tarefaRecuperada->delete();
        //Esse método verifica se não há mais determinado registro no banco de dados
        $this->assertDatabaseMissing('tarefas', ['id' => $tarefaRecuperada->id]);
    }
    
}
