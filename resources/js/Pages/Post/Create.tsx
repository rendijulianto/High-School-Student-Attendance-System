import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
const Create = ({ auth }: PageProps) => {
    const { data, setData, errors, post } = useForm({
        title: "",
        description: "",
    });

    function handleSubmit(e: any) {
        e.preventDefault();
        post(route("posts.store"));
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Tambah Post
                </h2>
            }
        >
            <Head title="Dashboard" />
            <div className="mt-20">
                <div className="container flex flex-col justify-center mx-auto">
                    <div>
                        <h1 className="mb-8 text-3xl font-bold">
                            <Link
                                href={route("posts.index")}
                                className="text-indigo-600 hover:text-indigo-700"
                            >
                                Posts
                            </Link>
                            <span className="font-medium text-indigo-600">
                                {" "}
                                /{" "}
                            </span>
                            Create
                        </h1>
                    </div>
                    <div className="max-w-6xl p-8 bg-white rounded shadow">
                        <form name="createForm" onSubmit={handleSubmit}>
                            <div className="flex flex-col">
                                <div className="mb-4">
                                    <label className="">Title</label>
                                    <input
                                        type="text"
                                        className="w-full px-4 py-2"
                                        name="title"
                                        value={data.title}
                                        onChange={(e) =>
                                            setData("title", e.target.value)
                                        }
                                    />
                                    <span className="text-red-600">
                                        {errors.title}
                                    </span>
                                </div>
                                <div className="mb-0">
                                    <label className="">Description</label>
                                    <textarea
                                        className="w-full rounded"
                                        name="description"
                                        onChange={(e) =>
                                            setData(
                                                "description",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <span className="text-red-600">
                                        {errors.description}
                                    </span>
                                </div>
                            </div>
                            <div className="mt-4">
                                <button
                                    type="submit"
                                    className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
