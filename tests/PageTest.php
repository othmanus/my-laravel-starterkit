<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Page\Page;

class PageTest extends TestCase
{
	use DatabaseTransactions;

    /** @test */
    public function page_can_be_sluggable()
    {
    	$page = factory(App\Models\Page\Page::class)->create([
    		'title' => 'Title One',
    	]);

    	$this->assertEquals($page->slug, 'title-one');
    }

    /** @test */
    public function admin_can_create_a_page() 
    {
    	$admin = factory(App\Models\User\User::class)->create([
    		'role' => 'moderator',
    	]);

    	$this->actingAs($admin)
    		->visit(route('admin.pages.create'))
    		->type('About us', 'title')
    		->select('about', 'category')
    		->type('This is a random test page', 'content')
    		->press('save')
    		->seePageIs(route('admin.pages.index'));

    	$page = Page::latest()->first();
    	$this->assertEquals($page->title, 'About us');
    }

    /** @test */
    public function admin_can_edit_a_page() 
    {
    	$admin = factory(App\Models\User\User::class)->create([
    		'role' => 'moderator',
    	]);

    	$page = factory(App\Models\Page\Page::class)->create([
    		'title' => 'About us',
    		'category' => 'about',
    	]);

    	$this->actingAs($admin)
    		->visit(route('admin.pages.edit', $page->id))
    		->type('About us updated', 'title')
    		->press('save')
    		->seePageIs(route('admin.pages.index'));

    	$updated = Page::find($page->id);
    	$this->assertEquals($updated->title, 'About us updated');
    }

    /** 
     * @test 
     * The test bellow doesn't work because of modal delete
     * In order to get it work, add 'id="delete"' to delete button tag on pages.index
     */
    // public function admin_can_delete_a_page() 
    // {
    // 	$admin = factory(App\Models\User\User::class)->create([
    // 		'role' => 'moderator',
    // 	]);

    // 	$page = factory(App\Models\Page\Page::class)->create([
    // 		'title' => 'About us',
    // 		'category' => 'about',
    // 	]);

    // 	$this->actingAs($admin)
    // 		->visit(route('admin.pages.index'))
    // 		->press('delete')
    // 		->seePageIs(route('admin.pages.index'));

    // 	$updated = Page::count();
    // 	$this->assertEquals($updated, 0);
    // }
}
