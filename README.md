Issue: https://github.com/symfony/symfony/issues/31271

# Reproduce

1) `php -S localhost:8000 public/index.php`
> or `symfony serve`
2) go to [http://localhost:8000/broken]

# Routes

- `/` - works due to auto inject by `Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver`
- `/broken` - broken

# Debug container definitions

`bin/console debug:container invokable_controller`

## Autoconfigure

```
 ---------------- ------------------------------------ 
  Service ID       invokable_controller                
  Class            App\Controller\InvokableController  
  Tags             controller.service_arguments        
                   container.service_subscriber        
  Public           yes                                 
  Synthetic        no                                  
  Lazy             no                                  
  Shared           yes                                 
  Abstract         no                                  
  Autowired        no                                  
  Autoconfigured   yes                                 
 ---------------- ------------------------------------ 
```

## Autowire

When autowired controller, `AutowireRequiredMethodsPass` adds call `setContainer()` to controller service.

```
 ---------------- ------------------------------------ 
  Service ID       invokable_controller                
  Class            App\Controller\InvokableController  
  Tags             -                                   
  Calls            setContainer                        
  Public           no                                  
  Synthetic        no                                  
  Lazy             no                                  
  Shared           yes                                 
  Abstract         no                                  
  Autowired        yes                                 
  Autoconfigured   no                                  
 ---------------- ------------------------------------ 
```

## Manually tagged by controller.service_arguments/container.service_subscriber

```
 ---------------- ------------------------------------ 
  Service ID       invokable_controller                
  Class            App\Controller\InvokableController  
  Tags             container.service_subscriber        
                   controller.service_arguments        
  Public           yes                                 
  Synthetic        no                                  
  Lazy             no                                  
  Shared           yes                                 
  Abstract         no                                  
  Autowired        no                                  
  Autoconfigured   no                                  
 ---------------- ------------------------------------ 
```
