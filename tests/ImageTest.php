<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Image\Image;

class ImageTest extends TestCase
{

	use DatabaseTransactions;

	use WithoutMiddleware;


    /**
     * @test
     * 
     * Each model which have images should have an array of styles with their sizes
     * in order to create an image for each size.
     * For example: A page has large, medium and thumbnail styles
     * So for each image associated with a page, we copy the original and create three 
     * other images according to the size of each style. 
     */
    public function image_can_be_associated_for_a_page()
    {
    	$admin = factory(App\Models\User\User::class)->create(['role' => 'administrator']);

    	$image = factory(App\Models\Image\Image::class)->create([
            'file_name' => 'image.png',
            'path' => public_path("temp/image.png")
        ]);

        // $page->images()->save($image);
        $this->actingAs($admin)
        	->call('POST', route('admin.pages.store'), [
	        	'title' => 'Title',
	        	'category' => 'about',
	        	'content' => 'Random content',
	        	'images' => [$image->id]
        	]);

        $updated = Image::find($image->id);
        $page = \App\Models\Page\Page::latest()->first();

        // Check if image is associated to page
        $this->assertEquals($updated->imageable, $page);

        // Check original copy
        $this->assertTrue(\File::exists(public_path("uploads/pages/images/original/{$updated->file_name}")));

        // check image style created
        $this->assertTrue(\File::exists(public_path("uploads/pages/images/large/{$updated->file_name}")));
    }

    /** @test */
    public function image_can_be_deleted_for_a_page()
    {
        $admin = factory(App\Models\User\User::class)->create(['role' => 'administrator']);

        $image = factory(App\Models\Image\Image::class)->create([
            'file_name' => 'image.png',
            'path' => public_path("temp/image.png")
        ]);

        // $page->images()->save($image);
        $this->actingAs($admin)
            ->call('POST', route('admin.pages.store'), [
                'title' => 'Title',
                'category' => 'about',
                'content' => 'Random content',
                'images' => [$image->id]
            ]);

        $updated = Image::find($image->id);

        $page = \App\Models\Page\Page::latest()->first();

        // Check if image is associated to page
        $this->assertEquals($updated->imageable, $page);

        $this->actingAs($admin)
            ->call('DELETE', route('admin.pages.destroy', $page->id));

        // Check images table empty
        $this->assertEquals(Image::all()->count(), 0);
        
        // Check original copy is deleted
        $this->assertFalse(\File::exists(public_path("uploads/pages/images/original/{$updated->file_name}")));

        // check image style deleted
        $this->assertFalse(\File::exists(public_path("uploads/pages/images/large/{$updated->file_name}")));
    }
}
