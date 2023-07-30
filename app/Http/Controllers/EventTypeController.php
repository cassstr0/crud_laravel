<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los tipos de eventos
        $eventTypes = EventType::all();

        // Retornar la vista con los tipos de eventos
        return view('event-types', compact('eventTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario antes de guardarlos en la base de datos
        $validatedData = $request->validate([
            'name' => 'required',
            'background' => 'required',
            'border' => 'required',
            'text' => 'required',
        ]);

        // Crear un nuevo tipo de evento con los datos validados
        $eventType = new EventType();
        $eventType->name = $request->input('name');
        $eventType->background = $request->input('background');
        $eventType->border = $request->input('border');
        $eventType->text = $request->input('text');
        $eventType->save();

        return redirect()->route('event-types')->with('success', 'EventType created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventType)
    {
        // Retornar la vista para mostrar los detalles de un tipo de evento específico
        return view('event-types.show', compact('eventType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $eventType)
    {
        // Retornar la vista para editar un tipo de evento específico
        return view('event-types.edit', compact('eventType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventType $eventType)
    {
        // Validar los datos del formulario antes de actualizarlos en la base de datos
        $validatedData = $request->validate([
            'name' => 'required',
            'background' => 'required',
            'border' => 'required',
            'text' => 'required',
        ]);

        // Actualizar los valores del tipo de evento con los datos validados
        $eventType->name = $request->input('name');
        $eventType->background = $request->input('background');
        $eventType->border = $request->input('border');
        $eventType->text = $request->input('text');
        $eventType->save();

        return redirect()->route('event-types')->with('success', 'EventType updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventType $eventType)
    {
        // Eliminar el tipo de evento de la base de datos
        $eventType->delete();

        return redirect()->route('event-types')->with('success', 'EventType deleted successfully.');
    }
}
