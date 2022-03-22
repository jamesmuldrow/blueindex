<?php

namespace App\Http\Controllers\Command;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Command;


class CommandController extends Controller
{
    /**
     * Display the Command Create view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Command/Create');
    }
    
    public function store(Request $request)
    {
    
        $command = new Command; 
        $command->command = $request->command;
        $command->description = $request->description;
        
        $command->save();
        
        
        return redirect('commands');
    }
    
     public function update(Request $request)
    {
       
        $command = Command::find($request->id); 
        
        $command->command = $request->command;
        $command->description = $request->description;
        
        $command->update();
        
        return redirect('commands');
    }
    
    public function delete(Request $request)
    {
       
        $command = Command::find($request->id); 
        
        $command->delete();
        
        return redirect('commands');
    }
}
