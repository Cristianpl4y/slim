<?php 

namespace App\Controllers;
use App\Models\Post;
use Respect\Validation\Validator as v;

class PostController extends Controller
{
    public function create($request, $response)
    {
        if($request->isGet()){
            return $this->container->view->render($response, 'post/create.twig');
        }

        $validation = $this->container->validator->validate($request, [
            'title' => v::length(5)->notEmpty(),
            'description' => v::notEmpty()
        ]);

        if($validation->failed()){
            return $response->withRedirect($this->container->router->pathFor('post.create'));
        }

        Post::create([
            'title' => $request->getParam('title'),
            'description' => $request->getParam('description'),
            'published' => $request->getParam('published') == '0' ? false: true,
            'user_id' => $this->container->auth->user()->id
        ]);

        $this->container->flash->addMessage('success', 'Post foi adicionado com sucesso!');
        return $response->withRedirect($this->container->router->pathFor('post.create'));
        

    }
   
    public function edit($request, $response, $params)
    {
        $data = [
            'post' => Post::find($params['id'])
        ];

        return $this->container->view->render($response, 'post/edit.twig', $data);
    }
    
    public function update($request, $response, $params)
    {
        $post = Post::find($params['id']);

        $validation = $this->container->validator->validate($request, [
            'title' => v::length(5)->notEmpty(),
            'description' => v::notEmpty()
        ]);

        if($validation->failed()){
            return $response->withRedirect($this->container->router->pathFor('post.edit', ['id' => $post->id ]));
        }

        $post->title = $request->getParam('title');
        $post->description = $request->getParam('description');
        $post->published = $request->getParam('published');
        $post->save();

        $this->container->flash->addMessage('success', 'Post atualizado com sucesso!');

        return $response->withRedirect($this->container->router->pathFor('post.edit', ['id' => $post->id ]));
        
    }
    
    public function delete($request, $response)
    {
        $post = Post::find($request->getParam('id'));

        if($post){
            $post->delete();
            $this->container->flash->addMessage('success', 'Post deletado!');
        }else{
            $this->container->flash->addMessage('error', 'Post não pode ser deletado!');
        }

        return $response->withRedirect($this->container->router->pathFor('home'));
        
    }
}