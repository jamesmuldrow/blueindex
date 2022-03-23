<?php

namespace App\Http\Controllers\Command;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Command;


class CommandController extends Controller
{

    /**
     * Display the Command Index View
     * 
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
          
        return Inertia::render('Command/List', [
            'commands' => Command::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('command', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");  
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn($command) => [
                    'id' => $command->id,
                    'command' => $command->command,
                    'description' => $command->description
                ]),
            
            'filters' => $request->only(['search'])
        ]);

    
    }

    /**
     * Display the Command Create view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Command/Add');
    }
    

    public function store(Request $request)
    {
        //return Command::paginate(15);
    
        $command = new Command; 
        $command->command = $request->command;
        $command->description = $request->description;
        
        $command->save();
        
        
        return redirect('commands/?page=' . Command::paginate(5)->lastPage());
    }
    
     public function update(Request $request)
    {
       
        $command = Command::find($request->id); 
        
        $command->command = $request->command;
        $command->description = $request->description;
        
        $command->update();
        
        return redirect('commands');
    }

    /**
     * Edit Command data
     * 
     * @return redirect
     */
    public function edit($id)
    {

        return Inertia::render('Command/Edit',[
            'command' => Command::find($id)
        ]);
    }

    /**
     * Show Command data
     * 
     * @return redirect
     */
    public function show($id)
    {

        return Inertia::render('Command/Show',[
            'command' => Command::find($id)
        ]);
    }
    
    public function destroy(Request $request)
    {
       
        $command = Command::find($request->id); 
        
        $command->delete();
        
        return redirect('commands');
    }
}
